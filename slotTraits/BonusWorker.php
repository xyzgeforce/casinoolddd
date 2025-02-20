<?php
/**
 * Casino logic
 *
 * Основные файлы логики
 *
 * @category Casino Slots
 * @author Kirill Speransky
 */


/**
 * Class BonusWorker
 *
 * Проверка, установка бонусов. Получение информации по бонусам
 */
trait BonusWorker {

    /**
     * Проверка переданных бонусов и запуск нужных
     *
     * Может передаваться как один бонус так и массив бонусов
     */
    private function checkBonus() {
        $bonus = $this->spinBonus;

        if(!empty($bonus['type'])) {
            $this->executeBonus($bonus);
        }
        else {
            foreach($bonus as $b) {
                $this->executeBonus($b);
            }
        }
    }

    /**
     * Применение бонуса
     *
     * type - Обязательный параметр бонуса. Указывает тип бонуса
     * Для каждого типа бонуса идут дополнительные параметры
     *
     * @param array $bonus
     */
    private function executeBonus($bonus) {
        if(isset($bonus['type'])) {
            switch($bonus['type']) {
                case 'multiple':
                    $this->double = rnd($bonus['range'][0], $bonus['range'][1]);
                    break;
                case 'wildReel':
                    $this->setWildReel($bonus['number'], $this->wild[0]);
                    break;
                case 'randomWild':
                    $not = (empty($bonus['not'])) ? false : $bonus['not'];
                    $this->setRandomWild($bonus['range'], $not);
                    break;
                case 'multipleWithWild':
                    $this->setMultipleWithWild($bonus['multiple']);
                    break;
                case 'wildsOnPos':
                    $wildSymbol = (empty($bonus['wildSymbol'])) ? false : $bonus['wildSymbol'];
                    $this->setWildsOnPos($bonus['offsets'], $wildSymbol);
                    break;
                case 'wildReels':
                    $this->setWildReels($bonus['reels']);
                    break;
                case 'fullWildReels':
                    $this->setFullWildReels($bonus['reels']);
                    break;
                case 'expandWild':
                    $this->checkExpandWild($bonus['reels'], $bonus['symbolsID'], $bonus['wild']);
                    break;
                case 'testFS':
                    $this->setScatters();
                    break;
                case 'stepWild':
                    $this->setStepWild($bonus['steps']);
                    break;
                case 'setWildsIf':
                    $this->setWildsIf($bonus['symbol'], $bonus['reel'], $bonus['countConfig']);
                    break;
                case 'odinRavens':
                    $this->odinRavens($bonus['positions'], $bonus['x3Chance'], $bonus['x6Chance']);
                    break;
                case 'setReelsOffsets':
                    $this->setReelsOffsets($bonus['offsets']);
                    break;
                case 'wildReelsOfSymbol':
                    $this->setWildReelsOfSymbol($bonus['symbol'], $bonus['reels'], $bonus['wildSymbol']);
                    break;
                case 'randomWildsOnPos':
                    $this->setRandomWildsOnPos($bonus['positions'], $bonus['wildSymbol'], $bonus['wildsCount']);
                    break;
                case 'wildReelsIfSymbol':
                    $this->setWildReelsIfSymbol($bonus['symbol'], $bonus['offsets'], $bonus['wildSymbol'], $bonus['symbolIfEmpty'], $bonus['cancelIfLess']);
                    break;
                case 'randomReplace':
                    $this->setRandomReplace($bonus['symbols'], $bonus['replacement']);
                    break;
                case 'replace':
                    $this->setReplace($bonus['relation']);
                    break;
                case 'symbolOnPosition':
                    $this->setSymbolOnPosition($bonus['offsets'], $bonus['symbol']);
                    break;
                case 'randomWildIfSymbolCount':
                    $this->setRandomWildIfSymbolCount($bonus['offsets'], $bonus['symbol'], $bonus['needleCount'], $bonus['wildConfig']);
                    break;
                case 'multipleReel':
                    $this->setMultipleReel($bonus['wildConfig']);
                    break;
                case 'wildReelIfSymbolPresent':
                    $this->setWildReelIfSymbolPresent($bonus['symbol']);
                    break;
                case 'explodedWild':
                    $this->setExplodedWild($bonus);
                    break;
                case 'multipleBySymbolCount':
                    $this->setMultipleBySymbolCount($bonus['symbol'], $bonus['multipleInc']);
                    break;
                case 'wildsByLevel':
                    $this->setWildsByLevel($bonus);
                    break;
                case 'multipleByLevel':
                    $this->setMultipleByLevel($bonus);
                    break;
                case 'wildsExpansion':
                    $this->setWildsExpansion($bonus['wildsCount'], $bonus['wildsCountChance'], $bonus['wildsExpansionChance'], $bonus['wildSymbol']);
                    break;
                case 'KittyWaterBonus':
                    $this->setKittyWaterBonus();
                    break;
                case 'expandWildIfLines':
                    $this->setExpandWildIfLines($bonus['symbol']);
                    break;

            }
        }

    }

    public function setExpandWildIfLines($symbol) {
        $bonusData = array();
        $reelNumber = 0;

        $tmpReels = array();

        foreach($this->reels as $r) {
            $tmpReels[] = clone $r;

            $offsets = $r->checkSymbol(array($symbol), $reelNumber);
            if(count($offsets) > 0) {
                $r->setAsWild($symbol);
                $bonusData[] = array(
                    'reel' => $reelNumber,
                    'offsets' => $offsets,
                    'expandOffsets' => $this->getOtherOffsetsByReel($offsets, $reelNumber),
                );
            }
            $reelNumber++;
        }

        $present = $this->checkWinLinesPresent();

        if($present) {
            $this->bonusData = $bonusData;
            $this->tmpReels = $tmpReels;
        }
        else {
            $this->reels = $tmpReels;
        }
    }

    public function getMissRedBonus($report) {
        // r - row count
        $wolfChange = false;
        $ladyChange = false;
        for($r = 0; $r < 4; $r++) {
            // c - ceil count
            $wOffsets = array();
            $lOffsets = array();
            for($c = 0; $c < count($this->params->reelConfig); $c++) {
                if($this->chechSymbolOnReel('s02', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $wOffsets[] = $offset;
                }
                if($this->chechSymbolOnReel('s01', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $lOffsets[] = $offset;
                }
            }
            if(count($wOffsets) > 1) {
                $wF = $wOffsets[0] + 1;
                $wL = end($wOffsets);
                for($z = $wF; $z < $wL; $z++) {
                    $CeilRow = $this->getCeilRowByOffset($z);
                    $symbol = $this->getReelSymbol($CeilRow['ceil'], $CeilRow['row']);
                    $replace = 12;
                    if($symbol == 1 || $symbol == 11 || $symbol == 0) {
                        $replace = 0;
                    }
                    if($symbol !== 2) {
                        $wolfChange = true;
                        $this->reels[$CeilRow['ceil']]->setSymbolOnPosition($CeilRow['row'], $replace);
                    }

                }
            }
            if(count($lOffsets) > 1) {

                $wF = $lOffsets[0] + 1;
                $wL = end($lOffsets);
                for($z = $wF; $z < $wL; $z++) {
                    $CeilRow = $this->getCeilRowByOffset($z);
                    $symbol = $this->getReelSymbol($CeilRow['ceil'], $CeilRow['row']);
                    $replace = 11;
                    if($symbol == 2 || $symbol == 12 || $symbol == 0) {
                        $replace = 0;
                    }
                    if($symbol !== 1) {
                        $ladyChange = true;
                        $this->reels[$CeilRow['ceil']]->setSymbolOnPosition($CeilRow['row'], $replace);
                    }

                }
            }
        }

        for($r = 0; $r < 4; $r++) {
            // c - ceil count
            $wOffsets = array();
            $lOffsets = array();
            for($c = 0; $c < count($this->params->reelConfig); $c++) {
                if($this->chechSymbolOnReel('s02', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $wOffsets[] = $offset;
                }
                if($this->chechSymbolOnReel('e02', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $wOffsets[] = $offset;
                }
                if($this->chechSymbolOnReel('s01', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $lOffsets[] = $offset;
                }
                if($this->chechSymbolOnReel('e01', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $lOffsets[] = $offset;
                }
            }
            if(count($wOffsets) > 1) {
                $wF = $wOffsets[0] + 1;
                $wL = end($wOffsets);
                for($z = $wF; $z < $wL; $z++) {
                    $CeilRow = $this->getCeilRowByOffset($z);
                    $symbol = $this->getReelSymbol($CeilRow['ceil'], $CeilRow['row']);
                    $replace = 12;
                    if($symbol == 1 || $symbol == 11 || $symbol == 0) {
                        $replace = 0;
                    }
                    if($symbol !== 2) {
                        $wolfChange = true;
                        $this->reels[$CeilRow['ceil']]->setSymbolOnPosition($CeilRow['row'], $replace);
                    }

                }
            }
            if(count($lOffsets) > 1) {

                $wF = $lOffsets[0] + 1;
                $wL = end($lOffsets);
                for($z = $wF; $z < $wL; $z++) {
                    $CeilRow = $this->getCeilRowByOffset($z);
                    $symbol = $this->getReelSymbol($CeilRow['ceil'], $CeilRow['row']);
                    $replace = 11;
                    if($symbol == 2 || $symbol == 12 || $symbol == 0) {
                        $replace = 0;
                    }
                    if($symbol !== 1) {
                        $ladyChange = true;
                        $this->reels[$CeilRow['ceil']]->setSymbolOnPosition($CeilRow['row'], $replace);
                    }

                }
            }
        }

        $this->resetSlotData();
        $this->startRows = $this->getRows();
        $this->startFullRows = $this->getFullRows();
        $this->spinBonus = array();

        $report = $this->getReport();
        $report['wolfChange'] = $wolfChange;
        $report['ladyChange'] = $ladyChange;
        $report['replace'] = array();

        return $report;
    }

    public function getMissRedBonusFree($report) {
        $wilds = $this->getSymbolAnyCount('w01');


        $wolfChange = false;
        for($r = 0; $r < 4; $r++) {
            // c - ceil count
            $wOffsets = array();
            for($c = 0; $c < count($this->params->reelConfig); $c++) {
                if($this->chechSymbolOnReel('w01', $c, $r)) {
                    $offset = $this->getOffsetByCeilRow($c, $r);
                    $wOffsets[] = $offset;
                }
            }
            if(count($wOffsets) > 1) {
                $wF = $wOffsets[0] + 1;
                $wL = end($wOffsets);
                for($z = $wF; $z < $wL; $z++) {
                    $CeilRow = $this->getCeilRowByOffset($z);
                    $symbol = $this->getReelSymbol($CeilRow['ceil'], $CeilRow['row']);
                    $replace = 20;
                    if($symbol !== 0) {
                        $wolfChange = true;
                        $this->reels[$CeilRow['ceil']]->setSymbolOnPosition($CeilRow['row'], $replace);
                    }

                }
            }
        }

        $this->resetSlotData();
        $this->startRows = $this->getRows();
        $this->startFullRows = $this->getFullRows();
        $this->spinBonus = array();

        $report = $this->getReport();
        $report['wolfChange'] = $wolfChange;
        $report['replace'] = $wilds;

        return $report;
    }


    private function setKittyWaterBonus() {
        $r = $this->getSymbolAnyCount('w02');
        if($r['count'] > 0) {
            $_SESSION['wildLevel']++;
        }

        $wilds = array(0,102);
        if($_SESSION['wildLevel'] > 2) {
            $wilds = array(0,102,1);
        }
        if($_SESSION['wildLevel'] > 5) {
            $wilds = array(0,102,1,2);
        }
        if($_SESSION['wildLevel'] > 8) {
            $wilds = array(0,102,1,2,3);
        }
        if($_SESSION['wildLevel'] > 11) {
            $wilds = array(0,102,1,2,3,4);
        }
        $this->setWilds($wilds);
    }

    private function setWildsExpansion($wildsCount, $wildsCountChance, $wildsExpansionChance, $wildSymbol) {
        $reelsCount = $this->getReelsCount() - 1;
        $rows = $this->rows - 1;

        $wc = $wildsCount[$this->getRandParam($wildsCountChance)];
        $maxOffset = $reelsCount * $rows - 1;
        $wildsOffsets = array();
        while(count($wildsOffsets) < $wc) {
            $rnd = rnd(0,$maxOffset);
            if(!in_array($rnd, $wildsOffsets)) {
                $wildsOffsets[] = $rnd;
            }
        }
        $wildExpansion = array();
        $wildsOffsetAdd = array();
        foreach($wildsOffsets as $w) {
            if(rnd(1, $wildsExpansionChance) == 1) {
                $ceilRow = $this->getCeilRowByOffset($w);
                $ceil = $ceilRow['ceil'];
                $row = $ceilRow['row'];
                if(rnd(0,1) == 0) $add1 = -1;
                else $add1 = 1;
                if(rnd(0,1) == 0) $add2 = -1;
                else $add2 = 1;
                $ceil += $add1;
                $row += $add2;
                if($ceil < 0) $ceil += 2;
                if($ceil > $reelsCount) $ceil -= 2;
                if($row < 0) $row += 2;
                if($row > $rows) $row -= 2;
                $newOffset = $this->getOffsetByCeilRow($ceil, $row);
                $wildsOffsetAdd[] = $newOffset;
                $wildExpansion[] = array(
                    'main' => $w,
                    'expansion' => $newOffset,
                );
            }
        }

        $fullOffsets = array_merge($wildsOffsets, $wildsOffsetAdd);

        $this->setWildsOnPos($fullOffsets, $wildSymbol);

        $this->bonusData = array(
            'wildsOffsets' => $wildsOffsets,
            'wildExpansion' => $wildExpansion,
        );
    }

    /**
     * Устанавливает общий множитель в зависимости от количества выпавших символов за определенный период игры
     *
     * @param $bonus
     */
    private function setMultipleByLevel($bonus) {
        $increaseCount = $this->getSymbolAnyCount($bonus['increaseSymbol'])['count'];
        $finalLevel = $bonus['currentLevel'] + $increaseCount;
        foreach($bonus['steps'] as $c=>$w) {
            if($finalLevel >= $c) {
                $this->double = $w;
            }
        }
    }


    /**
     * Устанавливает вайлды в зависимости от количества выпавших символов за определенный период игры
     *
     * @param $bonus
     */
    private function setWildsByLevel($bonus) {
        $increaseCount = $this->getSymbolAnyCount($bonus['increaseSymbol'])['count'];
        $finalLevel = $bonus['currentLevel'] + $increaseCount;
        foreach($bonus['steps'] as $c=>$w) {
            if($finalLevel >= $c) {
                $this->setWilds($w);
            }
        }
    }



    /**
     * Устанавливает множитель всех выигрышей, в зависимости от количества выпавших символов на барабанах.
     *
     * @param string $symbol Количество символов = множитель.
     * @param int $multipleInc Дополнительное значение, которое прибавляется к итоговому множетелю. Может быть отрицательным.
     */
    private function setMultipleBySymbolCount($symbol, $multipleInc) {
        $info = $this->getSymbolAnyCount($symbol);
        $resultMultiple = $info['count'] + $multipleInc;
        if($resultMultiple < 1) {
            $resultMultiple = 1;
        }
        $this->double = $resultMultiple;
    }

    /**
     * Бонус Pirate Attack в Treasure island.
     *
     * @param array $config
     */
    private function setExplodedWild($config) {
        $this->bonusIterateCount = 0;

        $e = $this->getSymbolAnyCount($config['explodedSymbol']);
        $bonusData = array();


        $tmp = explode(',', $config['nonChangedSymbol']);

        $nonChanged = array();
        foreach($tmp as $s) {
            $info = $this->getSymbolAnyCount($s);
            $nonChanged = array_merge($nonChanged, $info['offsets']);
        }
        $tmp = $nonChanged;
        $nonChanged = array();
        $nonChanged['offsets'] = $tmp;

        $explodedSymbolReplaceId = $this->params->getSymbolID($config['explodedSymbolReplace'])[0];
        $newWildSymbolId = $this->params->getSymbolID($config['newWildSymbol'])[0];

        $missSymbolId = $this->params->getSymbolID($config['missSymbol'])[0];

        $explodedOffsets = array();

        $missOffsets = array();
        $explodedCount = 0;
        if($e['count'] >= $config['countToStart']) {
            $cnt = $config['hitsCount'][$config['hitsChance'][rnd(0, count($config['hitsChance'])-1)]];
            for($i = 0; $i < $cnt; $i++) {
                if(($i < $e['count'] || (count($explodedOffsets) / $config['newWildsCount']) !== $cnt) && $explodedCount != $e['count']) {
                    if(rnd(0, 100) <= $config['missChance']) {
                        $m = $config['offsets'][rnd(0, count($config['offsets'])-1)];
                        while(in_array($m, $explodedOffsets) || in_array($m, $e['offsets']) || in_array($m, $missOffsets)) {
                            $m = $config['offsets'][rnd(0, count($config['offsets'])-1)];

                            if(++$this->bonusIterateCount > 1000) {
                                return;
                            }
                        }
                        $missOffsets[] = $m;

                        $bonusData[] = array(
                            'changed' => false,
                            'explodeOffset' => $m,
                        );
                    }
                    else {
                        $reelNumber = $e['offsets'][$explodedCount] % count($this->params->reelConfig);
                        $p = floor($e['offsets'][$explodedCount] / count($this->params->reelConfig));
                        $this->reels[$reelNumber]->setSymbolOnPosition($p, $explodedSymbolReplaceId);
                        $newExplodedOffsets = array();
                        while(count($newExplodedOffsets) !== $config['newWildsCount']) {
                            $newOffset = $config['offsets'][rnd(0, count($config['offsets'])-1)];
                            if(in_array($newOffset, $explodedOffsets) || in_array($newOffset, $nonChanged['offsets']) || in_array($newOffset, $e['offsets'])) {

                            }
                            else {
                                $newExplodedOffsets[] = $newOffset;
                                $explodedOffsets[] = $newOffset;
                            }

                            if(++$this->bonusIterateCount > 1000) {
                                return;
                            }
                        }
                        $bonusData[] = array(
                            'changed' => true,
                            'explodeOffset' => $e['offsets'][$explodedCount],
                            'newOffsets' => $newExplodedOffsets,
                        );
                        $explodedCount++;
                    }

                }
                else {
                    $m = $config['offsets'][rnd(0, count($config['offsets'])-1)];
                    while(in_array($m, $explodedOffsets) || in_array($m, $e['offsets']) || in_array($m, $missOffsets)) {
                        $m = $config['offsets'][rnd(0, count($config['offsets'])-1)];

                        if(++$this->bonusIterateCount > 1000) {
                            return;
                        }
                    }
                    $missOffsets[] = $m;
                    $bonusData[] = array(
                        'changed' => false,
                        'explodeOffset' => $m,
                    );
                }
            }

            $this->setWildsOnPos($explodedOffsets, $newWildSymbolId);
            $this->setWildsOnPos($missOffsets, $missSymbolId);
        }

        $this->bonusData['explode'] = $bonusData;
        $this->bonusData['explodeOffsets'] = $explodedOffsets;
        $this->bonusData['missOffsets'] = $missOffsets;

    }

    /**
     * Устанавливает барабан в wild-reel, если на барабане присутствует символ
     *
     * @param int $symbol Числовой идентификатор символа
     */
    private function setWildReelIfSymbolPresent($symbol) {
        $reelNumber = 0;
        $bonusData = array();
        foreach($this->reels as $r) {
            $offsets = $r->checkSymbol(array($symbol), $reelNumber);
            if(count($offsets) > 0) {
                $r->setAsWild($symbol);
                $bonusData[] = array(
                    'reel' => $reelNumber,
                    'offsets' => $offsets,
                );
            }

            $reelNumber++;
        }
    }

    /**
     * Устанавливает множитель для всех выиграшей, если какие-то барабаны полностью заполнены вайлдом(или любым другим символом)
     * в $wildConfig передаются барабаны множителей и ID вайлда\символа для проверки
     *
     * @param array $wildConfig
     */
    private function setMultipleReel($wildConfig) {
        $bonusData = array();
        $rCount = 0;
        foreach($this->reels as $r) {
            if($r->checkFullReelSymbol($wildConfig['wildSymbol'])) {
                $stop = rnd(0, count($wildConfig['multipleReels'][$rCount])-1);
                $multiple = $wildConfig['multipleReels'][$rCount][$stop];
                $this->double *= $multiple;

                $bonusData[] = array(
                    'reel' => $rCount,
                    'multiple' => $multiple,
                    'stop' => $stop,
                );
            }
            $rCount++;
        }

        $this->bonusData = $bonusData;
    }


    /**
     * Устанавливает вайлды(или любой символ) на переданные позиции в рандомном количестве\порядке, если на слоте выпало нужное количество выбранных символов
     *
     * @param array $offsets Возможные позиции вайлдов\новых символов
     * @param string $symbol Символ, по которому идет проверка
     * @param int $needleCount Количество символов, с которым начнется установка вайлдов\новых символов
     * @param array $wildConfig Описание количества вайлдов, шанса количества вайлда и символ вайлда
     */
    private function setRandomWildIfSymbolCount($offsets, $symbol, $needleCount, $wildConfig) {
        $sReport = $this->getSymbolAnyCount($symbol);
        if($sReport['count'] == $needleCount) {
            $r = $wildConfig['wildCountRangeChance'][rnd(0, count($wildConfig['wildCountRangeChance']) - 1)];
            $wildsCount = $wildConfig['wildCountRange'][$r];
            shuffle($offsets);
            $wildsOffsets = array_slice($offsets, 0, $wildsCount);

            $this->setSymbolOnPosition($wildsOffsets, $wildConfig['wildSymbol']);
        }
    }

    /**
     * Устанавливает символ на переданные оффсеты
     *
     * @param array $offsets
     * @param string $symbol
     */
    private function setSymbolOnPosition($offsets, $symbol) {
        $id = $this->params->getSymbolID($symbol);
        foreach($offsets as $pos) {
            $reelNumber = $pos % count($this->params->reelConfig);
            $p = floor($pos / count($this->params->reelConfig));
            $this->reels[$reelNumber]->setSymbolOnPosition($p, $id[0]);
        }
    }

    /**
     * Заменяет переданные символы на другие в прямом порядке
     *
     * @param array $relation
     */
    private function setReplace($relation) {
        foreach($relation as $o=>$n) {
            $oID = $this->params->getSymbolID($o);
            $nID = $this->params->getSymbolID($n);
            foreach($this->reels as $r) {
                $r->replaceSymbols($oID[0], $nID[0]);
            }
        }
    }

    /**
     * Заменяет каждый $symbols на случайный из $replacement
     *
     * @param array $symbols
     * @param array $replacement
     */
    private function setRandomReplace($symbols, $replacement) {
        $replacementArray = array();
        foreach($symbols as $s) {
            $symbolStr = $this->params->getSymbolByID(array($s));
            $rnd = $replacement[rnd(0, count($replacement)-1)];
            $replacementArray[$symbolStr] = $this->params->getSymbolByID(array($rnd));
            foreach($this->reels as $r) {
                $r->replaceSymbols($s, $rnd);
            }
        }
        $this->bonusData['replaced'] = $replacementArray;
    }

    /**
     * Устанавливает барабаны в вайлд, в зависимости от количества выпавших символов и наличие символов для замены
     *
     * @param string $symbol Если выпал данный символ, то барабаны могут превратиться в wild
     * @param array $offsets Оффсет символов для замены на вайлд барабаны.
     * @param int $wildSymbol ID вайлда для установки в wild-барабан
     * @param string $symbolIfEmpty Если переданный offset пустой, то проверяет наличие оффсетов по данному символу
     * @param int $cancelIfLess Отменять установку барабанов, если переданной значение минус новое количество символов для замены меньше единицы (0 или менее)
     */
    private function setWildReelsIfSymbol($symbol, $offsets, $wildSymbol, $symbolIfEmpty, $cancelIfLess) {
        $info = $this->getSymbolAnyCount($symbol);
        $changedOffsets = array();
        $eInfo = $this->getSymbolAnyCount($symbolIfEmpty);
        $diff = $eInfo['count'] - count($offsets);
        if($cancelIfLess - $diff < 1) {

        }
        else {
            if($info['count'] > 0) {
                if(count($offsets) == 0) {

                    $offsets = $eInfo['offsets'];
                }
                for($i = 0; $i < $info['count']; $i++) {
                    if(isset($offsets[$i])) {
                        $reelNumber = $offsets[$i] % count($this->params->reelConfig);
                        $this->setWildReel($reelNumber, $wildSymbol);
                        $changedOffsets[] = $offsets[$i];
                    }
                }
            }
        }
        $this->bonusData['changedOffsets'] = $changedOffsets;
    }

    /**
     * Устанавливает вайлды в рандомные переданные оффсеты на барабаны.
     *
     * @param array $positions Допустимые позиции для вайлдов
     * @param int $wildSymbol Чистолой идентификатор вайлда
     * @param int $wildsCount Количество вайдов
     */
    private function setRandomWildsOnPos($positions, $wildSymbol, $wildsCount) {
        shuffle($positions);
        $shufflePositions = array_splice($positions, 0, $wildsCount);

        $this->setWildsOnPos($shufflePositions, $wildSymbol);

        $this->bonusData['wildsOffsets'] = $shufflePositions;
    }

    /**
     * Устанавливает барабаны в wild-reels в зависимости от количества выпавших символов
     *
     * @param string $symbol Символ, по которому будет подсчитываться количество wild-барабанов
     * @param array $reels Номера барабанов, которые могут стать wild
     * @param int $wildSymbol ID вайлда, который будет установлен на wild-барабаны
     */
    private function setWildReelsOfSymbol($symbol, $reels, $wildSymbol) {
        $info = $this->getSymbolAnyCount($symbol);
        $cnt = $info['count'];
        $wildReelsNumbers = array();
        while(count($wildReelsNumbers) !== $cnt) {
            $reelNumber = $reels[rnd(0, count($reels)-1)];
            if(in_array($reelNumber, $wildReelsNumbers)) {

            }
            else {
                $wildReelsNumbers[] = $reelNumber;
                $this->setWildReel($reelNumber, $wildSymbol);
            }
        }
        $this->bonusData['wildReels'] = $wildReelsNumbers;
        $this->bonusData['symbolInfo'] = $info;
    }



    /**
     * Если определенный символ присутствует на определенном барабане,
     * то случайные символы превращаются в вайлды. Количество превращений указано в countConfig
     *
     * @param string $symbol
     * @param int $reel
     * @param array $countConfig
     */
    private function setWildsIf($symbol, $reel, $countConfig) {
        $offset = $this->checkSymbolOnReelAnyPosition($symbol, $reel);
        if($offset) {
            $count = $countConfig['count'][$countConfig['countRnd'][rnd(0, count($countConfig['countRnd'])-1)]];
            $wildOffsets = array();
            while(count($wildOffsets) != $count) {
                $rnd = rnd(0,14);
                if(in_array($rnd, $wildOffsets) || $rnd == $offset) {

                }
                else {
                    $wildOffsets[] = $rnd;
                }
            }
            $this->bonusData = array(
                'randomWilds' => $wildOffsets,
                'baseWildOffset' => $offset,
            );
            $wildOffsets[] = $offset;
            $this->setWildsOnPos($wildOffsets);
        }

    }

    /**
     * Устанавливает барабан в wild-барабан
     *
     * @param int $reelNumber Номер барабана
     * @param int $wild Числовой идентификатор вайлда
     */
    private function setWildReel($reelNumber, $wild) {
        $this->reels[$reelNumber]->setAsWild($wild);
    }

    /**
     * Устанавливает барабан(все его символы) в wild-барабан
     *
     * @param int $reelNumber Номер барабана
     * @param int $wild Числовой идентификатор вайлда
     */
    private function setFullWildReel($reelNumber, $wild) {
        $this->reels[$reelNumber]->setAsFullWild($wild);
    }

    /**
     * Устанавливает рандомное число вайлдов в зависимости от диапазона ($range)
     *
     * Если передан $not, то на этот offset нельзя поставить wild
     *
     * @param array $range Диапазон количества рандомных вайлдов
     * @param int $not Offset
     */
    private function setRandomWild($range, $not) {
        $size = $this->params->bonusRand[rnd(0, count($this->params->bonusRand)-1)];
        $arr = array();
        while(count($arr) != $size) {
            $r = rnd(0,14);
            if(!in_array($r, $arr) && $r !== $not) $arr[] = $r;
        }
        $this->setWildOnReels($arr);
    }

    /**
     * Устанавливает множитель и wild на средний символ слота (3 барабан, 2 позиция)
     *
     * @param int $multiple Множитель всех выигрышей
     */
    private function setMultipleWithWild($multiple) {
        $this->double = $this->double * $multiple;
        $this->reels[2]->setSymbolOnPosition(1, $this->wild[0]);
        $this->bonusData = array(
            'offsets' => array(7),
            'multiple' => $multiple,
        );
    }

    /**
     * Устанавливает wild на определенную позицию барабана по переданному offsets
     *
     * @param array $offsets Относительное положение символов на слоте
     * @param mixed $wildSymbol Если false, то берется $this->wild[0], иначе берется переданный $wildSymbol
     */
    public function setWildsOnPos($offsets, $wildSymbol = false) {
        if(!$wildSymbol) {
            $wildSymbol = $this->wild[0];
        }
        foreach($offsets as $pos) {
            $reelNumber = $pos % count($this->params->reelConfig);
            $p = floor($pos / count($this->params->reelConfig));
            $this->reels[$reelNumber]->setSymbolOnPosition($p, $wildSymbol);
        }
    }

    /**
     * Установка барабанов в wild-барабаны
     *
     * Если передан $setWild, то этот символ будет использоваться как Wild
     * Стандартно используется нулевой символ массива $this->wild
     *
     * @param array $reels Массив номеров барабанов(начинается с 0), которые нужно сделать wild-барабанами
     * @param bool $setWild
     */
    private function setWildReels($reels, $setWild = false) {
        $wild = $this->wild[0];
        if($setWild !== false) {
            $wild = $setWild;
        }
        foreach($reels as $reel) {
            $this->setWildReel($reel, $wild);
        }
        $offsets = array();
        foreach($reels as $r) {
            $offsets[] = $this->getReelOffset($r);
        }
        $this->bonusData = array(
            'reels' => $reels,
            'offsets' => $offsets,
        );
    }

    /**
     * Установка барабанов(всех символов, не только видимых) в wild-барабаны
     *
     * Если передан $setWild, то этот символ будет использоваться как Wild
     * Стандартно используется нулевой символ массива $this->wild
     *
     * @param array $reels Массив номеров барабанов(начинается с 0), которые нужно сделать wild-барабанами
     * @param bool $setWild
     */
    private function setFullWildReels($reels, $setWild = false) {
        $wild = $this->wild[0];
        if($setWild !== false) {
            $wild = $setWild;
        }
        foreach($reels as $reel) {
            $this->setFullWildReel($reel, $wild);
        }
        $offsets = array();
        foreach($reels as $r) {
            $offsets[] = $this->getReelOffset($r);
        }
        $this->bonusData = array(
            'reels' => $reels,
            'offsets' => $offsets,
        );
    }

    /**
     * Проверка на возможность сделать из барабана wild-барабан.
     *
     * Если отображаемые символы барабана содержат только символы, переданные в $symbolsID,
     * то отображаемые символы заменяются на $wild и барабан становится wild-барабаном
     *
     * @param array $reels Массив номеров барабанов(начинается с 0), на которых проходит проверка
     * @param array $symbolsID Массив числовых идентификаторов символов, которые должны быть на барабане
     * @param int $wild Идентификатор вайлда, который заменит все отображаемые символы барабана
     */
    private function checkExpandWild($reels, $symbolsID, $wild) {
        foreach($reels as $reel) {
            $r = $this->reels[$reel];
            $visible = $r->getVisibleSymbols();
            $f = true;
            foreach($visible as $symbol) {
                if(!in_array($symbol, $symbolsID)) {
                    $f = false;
                }
            }
            if($f) {
                $this->setWildReel($reel, $wild);
            }
        }
    }

    /**
     * Тестовый бонус для установки 3х скаттеров на последний барабан.
     * Этот бонус запускает фриспины.
     */
    private function setScatters() {
        $this->reels[4]->setSymbolOnPosition(0, $this->params->scatter[0]);
        $this->reels[4]->setSymbolOnPosition(1, $this->params->scatter[0]);
        $this->reels[4]->setSymbolOnPosition(2, $this->params->scatter[0]);
    }

    /**
     * Устанавливает вайлды на переданный offsets
     *
     * Вайлд берется как нулевой элемент $this->wild
     *
     * @param array $offsets
     */
    private function setWildOnReels($offsets) {
        $replacedSymbols = array();
        foreach($offsets as $pos) {
            $reelNumber = $pos % count($this->params->reelConfig);
            $p = floor($pos / count($this->params->reelConfig));
            $replacedSymbols[] = $this->reels[$reelNumber]->getVisibleSymbols()[$p];
            $this->reels[$reelNumber]->setSymbolOnPosition($p, $this->wild[0]);
        }
        $this->bonusData = array(
            'offsets' => $offsets,
            'replacedSymbols' => $replacedSymbols,
        );
    }

    /**
     * Устанавливаем нужные вайлды в зависимости от номера спина
     *
     * @param array $steps
     */
    private function setStepWild($steps) {
        $needleWilds = array();
        foreach($steps as $key=>$value) {
            if($this->step >= $key) {
                $needleWilds = $value;
            }
        }
        $this->setWilds($needleWilds);
    }

    /**
     * Бонус ворон одина
     *
     * @param array $positions
     * @param int $x3Chance
     * @param int $x6Chance
     */

    private function odinRavens($positions, $x3Chance, $x6Chance) {
        $present = $this->checkWinLinesPresent();
        if($present) {
            $multiple = 2;
            if(rnd(1, $x3Chance) == 1) {
                $multiple = 3;
            }
            $pos = $positions[rnd(0, count($positions) - 1)];
            $this->setWildOnReels(array($pos));
            $this->bonusWildsMultiple[] = array(
                'offset' => $pos,
                'multiple' => $multiple,
            );
            $resultPos = array($pos);
            if(rnd(1, $x6Chance) == 1) {
                $pos2 = $pos;
                while($pos2 == $pos) {
                    $pos2 = $positions[rnd(0, count($positions) - 1)];
                }
                $this->setWildOnReels(array($pos2));
                $newMultiple = 2;
                if($multiple == 2) $newMultiple = 3;
                $this->bonusWildsMultiple[] = array(
                    'offset' => $pos2,
                    'multiple' => $newMultiple,
                );
                $resultPos = array($pos, $pos2);
            }


            $this->bonusData = array(
                'randomWilds' => $resultPos,
            );
        }
    }

    /**
     * Устанавливает оффсеты для барабанов и обновляет символы
     *
     * @param array $offsets
     */
    public function setReelsOffsets($offsets) {
        for($i = 0; $i < count($offsets); $i++) {
            if($offsets[$i] !== false) {
                $this->reels[$i]->setOffset($offsets[$i]);
            }

        }
    }



    public function getExpandLines($symbol) {
        $tmpReels = array();

        foreach($this->reels as $r) {
            $tmpReels[] = clone $r;
            $offsets = $r->checkSymbol(array($symbol), 0);
            if(!empty($offsets)) {
                $r->setAsWild($symbol);
            }
        }

        $winLines = $this->getAnyPosWinLines($symbol);

        $resultLines = array();
        $v = array($symbol);
        $totalMultiple = 0;
        foreach($winLines as $w) {
            if($this->params->checkSymbolCount($v, $w['count'], $w['type'])) {
                $multiplier = $this->params->getWinMultiplier($v, $w['count'], $w['type']);
                $totalMultiple += $multiplier;

                $addArray = array(
                    'line' => $w['line'],
                    'multiple' => $multiplier * $w['double'],
                    'symbol' => $v,
                    'alias' => $this->params->getSymbolByID($v),
                    'count' => $w['count'],
                    'id' => $w['id'] + 1,
                    'collecting' => $w['collecting'],
                    'double' => $w['double'],
                    'withWild' => $w['withWild'],
                    'direction' => $w['direction'],
                    'useSymbols' => $w['useSymbols'],
                    'colNumber' => $w['colNumber'],
                    'type' => $w['type'],
                );

                $resultLines[] = $addArray;
            }
        }

        $this->reels = $tmpReels;

        return array(
            'totalMultiple' => $totalMultiple,
            'winLines' => $resultLines,
        );
    }



    /**
     * Получение данных по дополнительным выплатам по линиям
     *
     * Массив символов, которые проверяются содержится в параметрах игры в lineBonus['symbols']
     * Массив выплат по количеству содержится в lineBonus['multiplier']
     *
     * @param int $countSymbols
     * @return array
     *
     * totalMultiple - общий множитель по всем линиям, которые прошли
     * lines - массив линий, которые прошли. Содержит lineId(номер линии), multiple(множитель) и offsets(Положение символов на слоте)
     * win - true\false
     * count - Количество символов для проверки. То есть длина выигрышной линии.
     * primaryLine - ID последней выигрышной линии.
     */
    public function getFullLineBonus($countSymbols = 5) {
        $bonusArray = array(
            'totalMultiple' => 0,
            'lines' => array(),
            'win' => false,
            'count' => $countSymbols,
        );
        $paramSymbols = $this->params->lineBonus['symbols'];
        array_splice($paramSymbols, $countSymbols);
        foreach($this->lines as $i=>$line) {
            $symbols = $this->getLineSymbols($line);
            array_splice($symbols, $countSymbols);
            if(!array_diff($paramSymbols, $symbols) && !array_diff($symbols, $paramSymbols)) {
                $bonusArray['lines'][] = array(
                    'lineId' => $i + 1,
                    'multiple' => $this->params->lineBonus['multiplier'][$countSymbols],
                    'offsets' => $this->getOffsetsByLine($line, $countSymbols),
                );
                $bonusArray['primaryLine'] = $i + 1;
                $bonusArray['totalMultiple'] += $this->params->lineBonus['multiplier'][$countSymbols];
                $bonusArray['win'] = true;
            }
        }
        return $bonusArray;
    }

    /**
     *
     * Если есть выигрышные линии, то символы на этих линиях убираются и заменяются
     * предыдущими невидимыми символами слота. Репорт делается для каждой победы до тех пор,
     * пока выигрышных линий не будет.
     *
     * @param array $report - Репорт спина.
     * @param array $addOffset - Дополнительный массив оффсетов для сдвига
     * @param bool @getOffset
     * @param int $scattersCount
     * @return array
     */
    public function startAvalanche($report, $addOffset = array(), $getOffset = true, $scattersCount = 3) {
        $resultOffsets = array();
        foreach($report['winLines'] as $winLine) {
            if($getOffset) {
                $resultOffsets = array_merge($resultOffsets, $this->getOffsetsByLine($winLine['line'], $winLine['count']));
            }
            else {
                $resultOffsets = array_merge($resultOffsets, $winLine['line']);
            }

        }
        if($report['scattersReport']['count'] >= $scattersCount) {
            $resultOffsets = array_merge($resultOffsets, $report['scattersReport']['offsets']);
        }
        $resultOffsets = array_merge($resultOffsets, $addOffset);
        $resultOffsets = array_unique($resultOffsets);
        sort($resultOffsets);
        foreach($resultOffsets as $offset) {
            $reelNumber = $offset % count($this->params->reelConfig);
            $p = floor($offset / count($this->params->reelConfig));
            $this->reels[$reelNumber]->avalanche($p);
        }

        $this->step++;

        $this->resetSlotData();
    }

}
