
<?

class pyramidParams extends Params {
    public $reels = array(
        array(
            array(0,7,3,4,9,51,7,4,2,7,5,9,8,6,9,1,8,6,51,9,4,2,5,6,3,5,8,4,9,5,4,6,8,7,6,5,9,7,8,0,5,9,7,4,6,1,8,51,4,6,8,1,5,7,6,5,8,9,),
            array(4,2,7,9,3,5,8,0,6,9,8,6,51,9,7,1,4,8,5,9,7,3,6,8,5,51,9,4,1,8,7,6,8,5,9,3,6,9,51,5,4,2,5,9,4,0,5,2,1,5,4,8,1,5,2,8,7,6,5,4,8,7,9,3,),
            array(2,8,1,9,3,0,9,2,8,4,0,7,3,6,9,51,7,2,1,7,2,5,8,2,6,7,1,8,6,1,7,4,2,7,6,3,5,8,4,2,5,51,6,5,8,9,5,3,2,7,3,9,8,3,9,7,8,3,9,51,2,9,3,7,),
            array(4,2,7,1,5,3,8,0,6,4,8,6,51,9,7,1,4,8,2,5,7,6,3,9,5,7,9,4,3,7,8,9,7,5,0,3,2,8,9,3,6,2,4,5,7,6,5,7,3,2,5,6,3,5,2,7,6,3,),
            array(0,7,3,1,9,51,7,4,2,9,5,8,7,6,9,1,8,5,7,9,4,2,8,6,3,2,8,3,9,5,4,6,8,1,7,5,9,7,8,4,1,9,0,4,2,9,3,7,1,0,5,2,7,1,0,4,7,1,),
        ),
        array(
            array(0,7,3,9,5,51,7,4,2,7,5,8,7,6,9,1,8,6,9,8,4,3,2,6,3,9,8,4,9,5,7,9,8,6,9,),
            array(4,5,7,9,3,5,8,0,6,9,8,7,6,9,7,1,4,8,2,9,7,3,6,8,5,51,9,6,1,8,7,6,8,5,9,),
            array(2,8,1,9,3,0,9,2,8,4,0,7,3,6,9,5,7,4,9,7,8,5,7,51,6,9,8,5,6,8,9,4,2,7,6,),
            array(4,2,7,3,5,8,3,9,6,7,8,6,3,9,7,1,4,8,2,7,1,6,3,8,5,7,9,4,1,7,5,6,3,5,0,3,2,8,51,3,6,2,4,5,9,),
            array(0,7,3,6,9,51,7,4,1,9,5,8,51,6,4,1,8,5,51,9,4,2,8,6,3,5,8,3,9,5,4,6,8,7,6,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $symbols = array(
        'b01' => array(51),
        's01' => array(1),
        's02' => array(2),
        's03' => array(3),
        's04' => array(4),
        's05' => array(5),
        's06' => array(6),
        's07' => array(7),
        's08' => array(8),
        's09' => array(9),
        'w01' => array(0),
    );
    // Вайлд
    public $wild = array(0);
    public $doubleIfWild = true;
    // Скаттер
    public $scatter = array(10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2),
        array(0,0,1,2,1),
        array(2,2,1,0,1),
        array(1,0,1,2,2),
        array(1,2,1,0,0),
        // 10
        array(0,1,0,1,1),
        array(2,1,2,1,1),
        array(1,1,0,1,2),
        array(1,1,2,1,0),
        array(0,1,1,1,2),
        // 15
        array(2,1,1,1,0),
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $defaultCoinsCount = 15;

    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000,5000,10000,20000,30000,50000,100000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 500),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 's01', 'count'=> 2, 'multiplier'=> 3),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> 's02', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> 's03', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 'w01', 'count'=> 5, 'multiplier'=> 100000),
        array('symbol'=> 'w01', 'count'=> 4, 'multiplier'=> 1000),
        array('symbol'=> 'w01', 'count'=> 3, 'multiplier'=> 100),
        array('symbol'=> 'w01', 'count'=> 2, 'multiplier'=> 20),
    );
}