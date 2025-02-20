<?
require_once('IGTCtrl.php');

class fire_opalsCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1159-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Fire Opals"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="FireOpals"/>
    <param name="studio" value="interactive"/>
    <param name="nsbuyinamount" value=""/>
    <param name="buildnumber" value="4.2.F.O.CL104654_220"/>
    <param name="autopull" value="N"/>
    <param name="consoleCode" value="CSTM"/>
    <param name="BCustomViewHeight" value="47"/>
    <param name="BCustomViewWidth" value="1024"/>
    <param name="consoleTimeStamp" value="1349855268588"/>
    <param name="filtered" value="Y"/>
    <param name="defaultbuyinamount" value="0.0"/>
    <param name="xtautopull" value=""/>
    <param name="server" value="../../../../../"/>
    <param name="showInitialCashier" value="false"/>
    <param name="audio" value="on"/>
    <param name="nscode" value="MRGR"/>
    <param name="uniqueid" value="Guest"/>
    <param name="countrycode" value=""/>
    <param name="presenttype" value="FLSH"/>
    <param name="securetoken" value=""/>
    <param name="denomamount" value="'.$this->getDenominationAmount().'"/>
    <param name="skincode" value="MRGR"/>
    <param name="language" value="en"/>
    <param name="channel" value="INT"/>
    <param name="currencycode" value="'.$this->gameParams->curiso.'"/>
</params>';

        $this->outXML($xml);
    }

    protected function startPaytable($request) {
        $symbolPay = $this->getSymbolPay();

        $baseReel = $this->getReelXml($this->gameParams->reels[0]);
        $freeReel = $this->getReelXml($this->gameParams->reels[1]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="Fire Opals 720 Multiway 3x4x5x4x3" maxRTP="94.92" minRTP="92.99" name="Fire Opals" type="Slot" />
    <PrizeInfo name="PrizeInfoLeftRightBaseGame" strategy="PayMultiWayLeftRight">
        <Prize name="s01">
            <PrizePay count="5" pph="2829" value="2000" />
            <PrizePay count="4" pph="485" value="150" />
            <PrizePay count="3" pph="83" value="50" />
            <Symbol id="s01" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="386" value="500" />
            <PrizePay count="4" pph="86" value="75" />
            <PrizePay count="3" pph="23" value="25" />
            <Symbol id="s02" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="351" value="300" />
            <PrizePay count="4" pph="28" value="50" />
            <PrizePay count="3" pph="42" value="20" />
            <Symbol id="s03" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="87" value="125" />
            <PrizePay count="4" pph="13" value="30" />
            <PrizePay count="3" pph="18" value="15" />
            <Symbol id="s04" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="70" value="100" />
            <PrizePay count="4" pph="115" value="25" />
            <PrizePay count="3" pph="42" value="10" />
            <Symbol id="s05" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="95" value="100" />
            <PrizePay count="4" pph="126" value="20" />
            <PrizePay count="3" pph="143" value="5" />
            <Symbol id="s06" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="133" value="100" />
            <PrizePay count="4" pph="16" value="20" />
            <PrizePay count="3" pph="12" value="5" />
            <Symbol id="s07" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="150" value="100" />
            <PrizePay count="4" pph="284" value="20" />
            <PrizePay count="3" pph="35" value="5" />
            <Symbol id="s08" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="b01">
            <PrizePay count="5" pph="136" value="100" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftBaseGame" strategy="PayMultiWayRightLeft">
        <Prize name="s01">
            <PrizePay count="5" doNotGeneratePrize="true" value="2000" />
            <PrizePay count="4" pph="514" value="150" />
            <PrizePay count="3" pph="82" value="50" />
            <Symbol id="s01" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" doNotGeneratePrize="true" value="500" />
            <PrizePay count="4" pph="644" value="75" />
            <PrizePay count="3" pph="109" value="25" />
            <Symbol id="s02" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" doNotGeneratePrize="true" value="300" />
            <PrizePay count="4" pph="64" value="50" />
            <PrizePay count="3" pph="18" value="20" />
            <Symbol id="s03" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" doNotGeneratePrize="true" value="125" />
            <PrizePay count="4" pph="102" value="30" />
            <PrizePay count="3" pph="100" value="15" />
            <Symbol id="s04" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="82" value="25" />
            <PrizePay count="3" pph="12" value="10" />
            <Symbol id="s05" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="8" value="20" />
            <PrizePay count="3" pph="25" value="5" />
            <Symbol id="s06" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="17" value="20" />
            <PrizePay count="3" pph="49" value="5" />
            <Symbol id="s07" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="20" value="20" />
            <PrizePay count="3" pph="5" value="5" />
            <Symbol id="s08" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoLeftRightFreeSpin" strategy="PayMultiWayLeftRight">
        <Prize name="s10">
            <PrizePay count="5" pph="166" value="1000" />
            <PrizePay count="4" pph="26" value="150" />
            <PrizePay count="3" pph="18" value="50" />
            <Symbol id="s10" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" pph="35" value="300" />
            <PrizePay count="4" pph="5" value="75" />
            <PrizePay count="3" pph="4" value="25" />
            <Symbol id="s11" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s12">
            <PrizePay count="5" pph="22" value="200" />
            <PrizePay count="4" pph="22" value="50" />
            <PrizePay count="3" pph="10" value="15" />
            <Symbol id="s12" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s13">
            <PrizePay count="5" pph="12" value="125" />
            <PrizePay count="4" pph="2" value="25" />
            <PrizePay count="3" pph="8" value="10" />
            <Symbol id="s13" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s14">
            <PrizePay count="5" pph="20" value="125" />
            <PrizePay count="4" pph="2" value="25" />
            <PrizePay count="3" pph="15" value="10" />
            <Symbol id="s14" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s15">
            <PrizePay count="5" pph="22" value="100" />
            <PrizePay count="4" pph="33" value="20" />
            <PrizePay count="3" pph="63" value="5" />
            <Symbol id="s15" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s16">
            <PrizePay count="5" pph="37" value="100" />
            <PrizePay count="4" pph="28" value="20" />
            <PrizePay count="3" pph="14" value="5" />
            <Symbol id="s16" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s17">
            <PrizePay count="5" pph="38" value="100" />
            <PrizePay count="4" pph="58" value="20" />
            <PrizePay count="3" pph="20" value="5" />
            <Symbol id="s17" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="b02">
            <PrizePay count="5" pph="131" value="100" />
            <Symbol id="b02" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftFreeSpin" strategy="PayMultiWayRightLeft">
        <Prize name="s10">
            <PrizePay count="5" doNotGeneratePrize="true" value="1000" />
            <PrizePay count="4" pph="31" value="150" />
            <PrizePay count="3" pph="19" value="50" />
            <Symbol id="s10" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" doNotGeneratePrize="true" value="300" />
            <PrizePay count="4" pph="56" value="75" />
            <PrizePay count="3" pph="34" value="25" />
            <Symbol id="s11" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s12">
            <PrizePay count="5" doNotGeneratePrize="true" value="200" />
            <PrizePay count="4" pph="4" value="50" />
            <PrizePay count="3" pph="4" value="15" />
            <Symbol id="s12" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s13">
            <PrizePay count="5" doNotGeneratePrize="true" value="125" />
            <PrizePay count="4" pph="21" value="25" />
            <PrizePay count="3" pph="24" value="10" />
            <Symbol id="s13" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s14">
            <PrizePay count="5" doNotGeneratePrize="true" value="125" />
            <PrizePay count="4" pph="32" value="25" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="s14" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s15">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="2" value="20" />
            <PrizePay count="3" pph="6" value="5" />
            <Symbol id="s15" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s16">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="3" value="20" />
            <PrizePay count="3" pph="11" value="5" />
            <Symbol id="s16" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s17">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="3" value="20" />
            <PrizePay count="3" pph="3" value="5" />
            <Symbol id="s17" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterBaseGame" strategy="PayAny">
        <Prize name="s09">
            <PrizePay count="5" pph="33801" value="100" />
            <PrizePay count="4" pph="948" value="20" />
            <PrizePay count="3" pph="67" value="3" />
            <Symbol id="s09" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterFreeSpin" strategy="PayAny">
        <Prize name="s18">
            <PrizePay count="5" pph="35454" value="100" />
            <PrizePay count="4" pph="986" value="20" />
            <PrizePay count="3" pph="69" value="3" />
            <Symbol id="s18" required="false" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="50" min="50">
            <Step>50</Step>
        </PatternInfo>
        '.$this->getBetInfo().'
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame" />
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <DenominationList>
        <Denomination softwareId="200-1159-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>50.0</MaxBet>
    </GameBetInfo>
    <AutoSpinInfo enable="True">
        <Step>10</Step>
        <Step>20</Step>
        <Step>30</Step>
        <Step>40</Step>
        <Step>50</Step>
    </AutoSpinInfo>
    <VersionInfo>
        <GameLogicVersion>1.0</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>10</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="BaseGame.RightLeftMultiWay" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="BaseGame.LeftRightMultiWay" pay="0" stage="" totalPay="0" type="Pattern" />';
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043322165</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$fs.'
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="75">
            <Cell name="L0C0R0" stripIndex="75">s05</Cell>
            <Cell name="L0C0R1" stripIndex="76">s04</Cell>
            <Cell name="L0C0R2" stripIndex="77">s02</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="4">
            <Cell name="L0C1R0" stripIndex="4">s08</Cell>
            <Cell name="L0C1R1" stripIndex="5">s01</Cell>
            <Cell name="L0C1R2" stripIndex="6">s04</Cell>
            <Cell name="L0C1R3" stripIndex="7">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="38">
            <Cell name="L0C2R0" stripIndex="38">s05</Cell>
            <Cell name="L0C2R1" stripIndex="39">b01</Cell>
            <Cell name="L0C2R2" stripIndex="40">b01</Cell>
            <Cell name="L0C2R3" stripIndex="41">b01</Cell>
            <Cell name="L0C2R4" stripIndex="42">s07</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="108">
            <Cell name="L0C3R0" stripIndex="108">w01</Cell>
            <Cell name="L0C3R1" stripIndex="109">w01</Cell>
            <Cell name="L0C3R2" stripIndex="110">s06</Cell>
            <Cell name="L0C3R3" stripIndex="111">s03</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="113">
            <Cell name="L0C4R0" stripIndex="113">s09</Cell>
            <Cell name="L0C4R1" stripIndex="114">s02</Cell>
            <Cell name="L0C4R2" stripIndex="115">s06</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s11</Cell>
            <Cell name="L0C0R1" stripIndex="3">s11</Cell>
            <Cell name="L0C0R2" stripIndex="4">b02</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="168">
            <Cell name="L0C1R0" stripIndex="168">w02</Cell>
            <Cell name="L0C1R1" stripIndex="169">w02</Cell>
            <Cell name="L0C1R2" stripIndex="170">w02</Cell>
            <Cell name="L0C1R3" stripIndex="171">s13</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="5">
            <Cell name="L0C2R0" stripIndex="5">s12</Cell>
            <Cell name="L0C2R1" stripIndex="6">s14</Cell>
            <Cell name="L0C2R2" stripIndex="7">s16</Cell>
            <Cell name="L0C2R3" stripIndex="8">s17</Cell>
            <Cell name="L0C2R4" stripIndex="9">b02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">s18</Cell>
            <Cell name="L0C3R1" stripIndex="15">s13</Cell>
            <Cell name="L0C3R2" stripIndex="16">s14</Cell>
            <Cell name="L0C3R3" stripIndex="17">s10</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="10">
            <Cell name="L0C4R0" stripIndex="10">s15</Cell>
            <Cell name="L0C4R1" stripIndex="11">s18</Cell>
            <Cell name="L0C4R2" stripIndex="12">s17</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>'.$coinValue.'</BetPerPattern>
        <PatternsBet>'.$patternsBet.'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $obj = $request['PatternSliderInput'];
        $totalBet = $obj->PatternsBet;
        $betPerLine = (float) $obj->BetPerPattern;

        $stake = $totalBet * $betPerLine * $_SESSION['denominationAmount'];
        $pick = (int) $totalBet;

        $this->checkSpinAvailable($stake);

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[0], array(3,4,5,4,3));
        $this->slot->rows = 5;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
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
            case 'FREE':
                $this->showStartFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,4,5,4,3));
        $this->slot->rows = 5;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments(0, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

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

        $bonus = array();

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if( $r0 = $this->slot->checkSymbolOnReelAnyPosition('b01', 0) !== false &&
            $r1 = $this->slot->checkSymbolOnReelAnyPosition('b01', 1) !== false &&
                $r2 = $this->slot->checkSymbolOnReelAnyPosition('b01', 2) !== false &&
                    $r3 = $this->slot->checkSymbolOnReelAnyPosition('b01', 3) !== false &&
                        $r4 = $this->slot->checkSymbolOnReelAnyPosition('b01', 4) !== false   ) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = $report['betOnLine'] * 100;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        if( $r0 = $this->slot->checkSymbolOnReelAnyPosition('b02', 0) !== false &&
            $r1 = $this->slot->checkSymbolOnReelAnyPosition('b02', 1) !== false &&
                $r2 = $this->slot->checkSymbolOnReelAnyPosition('b02', 2) !== false &&
                    $r3 = $this->slot->checkSymbolOnReelAnyPosition('b02', 3) !== false &&
                        $r4 = $this->slot->checkSymbolOnReelAnyPosition('b02', 4) !== false   ) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = $report['betOnLine'] * 100;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $scatterPayReport = $this->slot->getSymbolAnyCount('s09');

        if($scatterPayReport['count'] >= 3 ) {
            $multiple = 3;
            if($scatterPayReport['count'] == 4) $multiple = 20;
            if($scatterPayReport['count'] == 5) $multiple = 100;
            $report['scattersReport'] = $scatterPayReport;
            $report['scattersReport']['totalWin'] = $report['bet'] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $scatterPayReport = $this->slot->getSymbolAnyCount('s18');

        if($scatterPayReport['count'] >= 3 ) {
            $multiple = 3;
            if($scatterPayReport['count'] == 4) $multiple = 20;
            if($scatterPayReport['count'] == 5) $multiple = 100;
            $report['scattersReport'] = $scatterPayReport;
            $report['scattersReport']['totalWin'] = $report['bet'] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $highlightRight = $this->getRightHighlight($report['winLines']);
        $display = $this->getDisplay($report);
        $leftWinLines = $this->getLeftWayWinLines($report);
        $rightWinLines = $this->getRightWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $sc = '<HighlightOutcome name="BaseGame.Scatter" type=""/>';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sc = $this->getScattersHighlight($report['scattersReport']['offsets']);
            $scattersPay = $this->getScattersPay($report['scattersReport'], 'BaseGame.Scatter', 's09');
        }
        else {
            $report['scattersReport']['totalWin'] = 0;
            $scattersPay = '';
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228740002404</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>50</Settled>
        <Pending>0</Pending>
        <Payout>'.$report['totalWin'].'</Payout>
    </OutcomeDetail>
    '.$highlightLeft.$highlightRight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>0</TotalAwarded>
        <Count>0</Count>
        <Countdown>0</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$display.$sc.$scattersPay.$leftWinLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$report['totalWin'].'" stage="" totalPay="'.$report['totalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$report['totalWin'].'" payName="" symbolCount="0" totalPay="'.$report['totalWin'].'" ways="0" />
    </PrizeOutcome>
    '.$rightWinLines.'
    <TransactionId>A2010-14296886706206</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }


    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $highlightRight = $this->getRightHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report);
        $rightWinLines = $this->getRightWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $gameTotal = $totalWin - $_SESSION['baseWinLinesWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$scattersHighlight.'
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlightLeft.$highlightRight.'

    '.$display.$display2.'
    <FreeSpinOutcome name="">
        <InitAwarded>10</InitAwarded>
        <Awarded>10</Awarded>
        <TotalAwarded>10</TotalAwarded>
        <Count>0</Count>
        <Countdown>10</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$leftWinLines.$rightWinLines.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="1" multiplier="1" name="Scatter" pay="0" payName="5 b01" symbolCount="5" totalPay="0" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0"/>
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 10;
        $_SESSION['fsLeft'] = 10;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlightLeft.$highlightRight.$leftWinLines.$rightWinLines, 9));
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines'], 'FreeSpin');
        $highlightRight = $this->getRightHighlight($report['winLines'], 'FreeSpin');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report, 'FreeSpin');
        $rightWinLines = $this->getRightWayWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $awarded = 0;
        $scattersHighlight = '';
        $scattersPay = '';
        if($report['scattersReport']['count'] > 2) {
            if($report['type'] == 'FREE') {
                $_SESSION['totalAwarded'] += 10;
                $_SESSION['fsLeft'] += 10;
                $awarded = 10;
                $report['scattersReport']['totalWin'] = 0;
                $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter', 'b02');
                $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
            }
            else {
                if(!empty($report['scattersReport']['totalWin'])) {
                    $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter', 's18');
                    $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
                }
            }
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $needBalance = $_SESSION['startBalance'];



        $_SESSION['fsTotalWin'] += $totalWin;

        $nextStage = 'FreeSpin';

        $baseReels = '';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
            $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['baseWinLinesWin'] + $_SESSION['fsTotalWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228769811206</TransactionId>
        <Stage>FreeSpin</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseScatter.'
    '.$highlightLeft.$highlightRight.$scattersHighlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>10</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$baseReels.$display.'

    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="0" payName="5 b01" symbolCount="5" totalPay="0" ways="0" />
    </PrizeOutcome>

    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    '.$leftWinLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    '.$rightWinLines.'
    <TransactionId>R1540-14228769811020</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}
