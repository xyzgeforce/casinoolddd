<?

class rockyCtrl extends Ctrl {

    protected  $knockOutBonus = array();

    protected function startInit($request) {
        if(empty($_SESSION['drawStates'])) {
            $draws = '<DrawState drawId="0"/>';
        }
        else {
            $gDraw = '';
            try {
                $gDraw = gzuncompress(base64_decode($_SESSION['drawStates']));
            }
            catch (Exception $e) {

            }
            if(!empty($_SESSION['savedState'])) {
                $savedState = '';
                foreach($_SESSION['savedState'] as $key=>$val) {
                    $savedState .= $val;
                }
                $draws = $savedState.$gDraw;
            }
            else $draws = $gDraw;
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <CustomerFunBalanceResponse balance="'.$this->getBalance().'" />
    <EEGOpenGameResponse gameId="'.$this->gameID.'">
        '.$draws.'
    </EEGOpenGameResponse>
    '.$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
        </DrawOdds>
        <DrawOdds payTableSet="1">
            <Prize odds="100" type="5S" />
            <Prize odds="10" type="4S" />
            <Prize odds="5" type="3S" />
            <Prize odds="1" type="2S" />
            <BetOdds type="scatter" />
        </DrawOdds>
    </EEGLoadOddsResponse>
    '.$this->gameParams->getReels().'</CompositeResponse>';

        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $betAttr = (array) $request->Bet;
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['stake'];
        $pick = substr($betAttr['pick'], 1);

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $this->slot->setDefaultReels();
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREESPIN':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $bonusCount = 0;

        $report['knockOut'] = $this->slot->getSymbolAnyCount('B');
        if($report['knockOut']['count'] == 2) {
            $this->getKnockOut($report);
            $report['totalWin'] += $this->knockOutBonus['bonusWin'];

            $report['kBonus'] = true;
            $bonusCount++;
        }
        else {
            $report['kBonus'] = false;
        }
        $report['rocky'] = $this->getRockyBonus($report);
        if($report['rocky'] != false) {
            $report['totalWin'] += $report['bet'] * 5;
            $report['spinWin'] += $report['bet'] * 5;
        }

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getFreeSpinBonus($report);
                $report['totalWin'] = $this->fsBonus['totalWin'];
                $report['type'] = 'FREESPIN';
                $bonusCount++;
            }
        }

        if($bonusCount > 1) $respin = true;

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'knockout':
                    if($report['knockOut']['count'] < 2) $respin = true;
                    break;
                case 'rocky':
                    if(!$report['rocky']) $respin = true;
                    break;
            }
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }
        if($report['kBonus']) {
            $kob = $this->knockOutBonus;
            $bonus .= '<Scatter offsets="'.implode(',', $report['knockOut']['offsets']).'" name="KnockOut" length="2" />';
            $bonus .= '<Feature name="KnockOut" payout="'.$kob['bonusWin'].'">
                    <Detail payDescs="'.implode(',', $kob['payDescs']).'" eventDescs="'.implode(',', $kob['eventDescs']).'" /></Feature>';
        }
        if($report['rocky'] != false) {
            $bonus .= '<Scatter offsets="'.implode(',', $report['rocky']).'" name="Rocky" length="5" payout="'.($report['bet'] * 5).'" />';
        }
        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
        ));

        if($report['kBonus']) {
            $winLines = $this->deleteWinLinesOption($winLines, 'drawWin');
            $winLines = $this->deleteWinLinesOption($winLines, 'lastSpins');
        }

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" freeGames="0" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        if($report['kBonus'] || $totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
            $_SESSION['bonus'] = 'knockout';
        }

        $this->outXML($xml);
    }

    private function getKnockOut($report) {
        $bonusParams = $this->gameParams->knockOutBonus;
        $knockOut = false;

        $bet = $report['bet'];
        $win = $bet * $bonusParams['multiple'];


        $this->knockOutBonus['bonusWin'] = 0;
        $this->knockOutBonus['eventDescs'] = array();
        $this->knockOutBonus['payDescs'] = array();

        $action = '';
        for($i = 1; $i <= 10; $i++) {
            if(!$knockOut) {
                $rnd = $this->getRandParam($bonusParams['rnd']);

                $action = $bonusParams['alias'][$rnd];

                if($i == 10) {
                    $action = 'K';
                }

                if($action == 'K') {
                    $knockOut = true;
                }
            }
            else {
                $action = 'W';
            }
            if($action == 'K' || $action == 'W') {
                $this->knockOutBonus['eventDescs'][] = $action;
                $this->knockOutBonus['payDescs'][] = $win;
                $this->knockOutBonus['bonusWin'] += $win;
            }
            else {
                $this->knockOutBonus['eventDescs'][] = $action;
                $this->knockOutBonus['payDescs'][] = 0;
            }
        }

        $this->bonusPays[] = array(
            'win' => $this->knockOutBonus['bonusWin'],
            'report' => $report,
        );

    }

    private function getRockyBonus($report) {
        $ro = $this->slot->checkSymbolOnReelAnyPosition('R', 0);
        $oo = $this->slot->checkSymbolOnReelAnyPosition('O', 1);
        $co =$this->slot->checkSymbolOnReelAnyPosition('C', 2);
        $ko = $this->slot->checkSymbolOnReelAnyPosition('K', 3);
        $yo =$this->slot->checkSymbolOnReelAnyPosition('Y', 4);
        if($ro != false && $oo != false && $co != false && $ko != false && $yo != false) {
            return array($ro, $oo, $co, $ko, $yo);
        }
        else {
            return false;
        }
    }

    public function getFreeSpinBonus($report) {
        $startWin = $report['totalWin'];

        $this->fsBonus['totalWin'] = $report['totalWin'];
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';

        $multiple = 2;
        $fsCount = 15;
        $totalFsCount = 15;

        switch($report['scattersReport']['count']) {
            case 3:
                $fsCount = 15;
                break;
            case 4:
                $fsCount = 20;
                break;
            case 5:
                $fsCount = 25;
                break;
        }

        $this->slot->setReels($this->gameParams->reels[1]);

        $fsCounter = 0;
        while($fsCount > 0) {
            $fsCounter++;
            $report = $this->slot->spin(array(
                'type' => 'multiple',
                'range' => array($multiple, $multiple),
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                if($sr['count'] >= 3) {
                    $fsCount += 15;
                    $totalFsCount += 15;
                }
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $multiple;
                $report['totalWin'] += $sr['totalWin'];
                $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }
            else {
                $bonus = '';
            }
            $report['rocky'] = $this->getRockyBonus($report);
            if($report['rocky'] != false) {
                $report['totalWin'] += $report['bet'] * 5;
                $bonus .= '<Scatter offsets="'.implode(',', $report['rocky']).'" name="Rocky" length="5" payout="'.($report['bet'] * 5).'" />';
            }

            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );

            $winLines = $this->getWinLinesData($report, array(
                'reelset' => 1,
                'currentSpins' => $totalFsCount,
                'spins' => $totalFsCount,
                'runningTotal' => $this->fsBonus['bonusWin'] + $startWin,
                'bonus' => $bonus,
                'addString' => ' multiplier="'.$multiple.'"',
            ));

            $drawState = '<DrawState drawId="'.$fsCounter.'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';
            $this->fsBonus['drawStates'] .= $drawState;


            $fsCount -= 1;
        }
        $this->fsBonus['fsCount'] = $fsCounter;
        $this->fsBonus['totalWin'] += $this->fsBonus['bonusWin'];
    }

    public function showFreeSpinReport($report, $totalWin) {
        $sr = $report['scattersReport'];

        $fsCount = 15;
        switch($sr['count']) {
            case 3:
                $fsCount = 15;
                break;
            case 4:
                $fsCount = 20;
                break;
            case 5:
                $fsCount = 25;
                break;
        }

        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" spins="'.$fsCount.'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';

        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $report['totalWin'] - $this->fsBonus['bonusWin'],
            'spins' => $fsCount,
            'currentSpins' => $fsCount,
            'bonus' => $bonus,
            'drawWin' => $report['totalWin'] - $this->fsBonus['bonusWin'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">'.$winLines.'
            <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
        </DrawState>'.$this->fsBonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGPlaceBetsResponse newBalance="'.$balanceWithoutBet.'" gameId="'.$this->gameID.'" />
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">
    '.$drawStates.'
    </EEGLoadResultsResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;
        $_SESSION['bonus'] = 'freespin';
    }

}
