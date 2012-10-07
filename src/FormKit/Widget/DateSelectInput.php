<?php
namespace FormKit\Widget;
use FormKit\Widget\SelectInput;
use FormKit\ResponseUtils;
use DateTime;
use DateTimeZone;

/**
 * DateHelper from Rails
 *
 * @see http://api.rubyonrails.org/classes/ActionView/Helpers/DateHelper.html
 */
class DateSelectInput extends TextInput
{
    public $class = array('formkit-widget','formkit-widget-dateselect');
    public $type = 'hidden';

    /**
     * @var string display display format
     */
    public $format;

    /**
     * @var string date format for storage
     *
     *  const string ATOM    = "Y-m-d\TH:i:sP";
     *  const string COOKIE  = "l, d-M-y H:i:s T";
     *  const string ISO8601 = "Y-m-d\TH:i:sO";
     *
     */
    public $data_format = DateTime::ISO8601;


    /**
     * @var boolean Convert date value to standard format (for front-end)
     */
    public $convert_format = false;

    public $start_year;

    public $end_year;

    public $formatOptions = array();

    public $dateValue;

    public $timezone;

    public function init() 
    {
        parent::init();

        if( $this->value )
            $this->loadValue();

        if( ! $this->timezone )
            $this->timezone = new DateTimeZone( ini_get('date.timezone') ?: 'Asia/Taipei' );
        
        if( ! $this->start_year )
            $this->start_year = 1980;

        if( ! $this->end_year )
            $this->end_year = (int) date('Y');

        $this->formatOptions = array(
            'Y' => array(),
            'm' => array(),
            'd' => array(),
        );

        foreach( range( $this->start_year ?: 1980, $this->end_year ) as $i )
            $this->formatOptions['Y'][ $i ] = $i;

        foreach( range( $this->start_year ?: 1980, $this->end_year ) as $i )
            $this->formatOptions['y'][ $i ] = substr($i,-2);

        foreach( range(1,12) as $m )
            $this->formatOptions['m'][ sprintf('%02d',$m) ] = sprintf('%02d',$m);

        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        foreach( $months as $m )
            $this->formatOptions['M'][ $m ] = $m;

        foreach( range(1,31) as $d )
            $this->formatOptions['d'][ sprintf('%02d',$d) ] = sprintf('%02d',$d);

        $days = array("Thu", "Fri", "Sat", "Sun", "Mon", "Tue", "Wed" );
        foreach( $days as $d )
            $this->formatOptions['D'][ $d ] = $d;

        foreach( range(1,31) as $j )
            $this->formatOptions['j'][ $j ] = $j;

        $this->formatOptions['a'] = array(
            'am' => 'am',
            'pm' => 'pm',
        );

        $this->formatOptions['A'] = array(
            'AM' => 'AM',
            'PM' => 'PM',
        );

        foreach( range(1,12) as $g )
            $this->formatOptions['g'][ $g ] = $g;

        foreach( range(0,23) as $G )
            $this->formatOptions['G'][ $G ] = $G;

        foreach( range(1,12) as $h )
            $this->formatOptions['h'][ $h ] = $h;

        foreach( range(0,23) as $H )
            $this->formatOptions['H'][ sprintf('%02d',$h) ] = sprintf('%02d',$h);

        foreach( range(0,59) as $i )
            $this->formatOptions['i'][ sprintf('%02d',$i) ] = sprintf('%02d',$i);

        foreach( range(0,59) as $s )
            $this->formatOptions['s'][ sprintf('%02d',$s) ] = sprintf('%02d',$s);
    }

    public function loadValue()
    {
        $this->dateValue = $this->inflateDate($this->value);
        // $this->timezone = $this->dateValue->getTimezone();
        $this->value = $this->deflateDate($this->dateValue);
    }

    public function inflateDate($date)
    {
        if( is_object($date) )
            return $date;
        if( is_string($date) ) {
            $newDate = DateTime::createFromFormat($this->data_format,$date);
            if($newDate === false)
                $newDate = DateTime::createFromFormat($this->format,$date);
            return $newDate;
        }
        if( is_numeric($date) )
            return new DateTime('@' . $date);
    }

    public function deflateDate($date)
    {
        if( is_object($date) ) 
            return $date->format($this->data_format);
        if( is_numeric($date) )
            return date($this->data_format,(int)$date);
        return $date;
    }

    public function render( $attributes = array() )
    {
        $this->setAttributes($attributes);
        $formatIds = array();
        $selfId = $this->getSerialId();
        $this->addId($selfId);

        $nodes = array();
        for ( $i = 0 ; $i < strlen($this->format) ; $i++ ) {
            $c = $this->format[ $i ];
            if( isset($this->formatOptions[$c]) ) {
                $value = null;
                if( $this->dateValue )
                    $value = $this->dateValue->format($c);
                elseif ( $this->value )
                    $value = $this->value;

                $select = new SelectInput(array(
                    'options' => $this->formatOptions[$c],
                    'value' => $value,
                    'allow_empty' => $this->allow_empty,
                ));
                $id = $this->getSerialId();
                $select->addId($id);
                $formatIds[ $c ] = $id;
                $nodes[] = $select;
            } else {
                $nodes[] = $c;
            }
        }

        $ids = array_values($formatIds);
        ob_start();
?>
<script>
// when changing selector values
// update date string by the format
(function() {
    var s = document.getElementById('<?=$selfId?>');
    var columns = <?=json_encode($formatIds)?>;
    var format = '<?=$this->format ?>';
    var data_format = '<?=$this->data_format?>';
    function updater() {
        var datestr = '';
        for ( var i = 0; i < format.length ; i++ ) {
            var c = format[i];
            var sid = columns[c];
            if(sid) {
                datestr += document.getElementById(sid).value;
            } else {
                datestr += c;
            }
        }

        // format date string
<?php if ($this->convert_format): ?>
        // parse datestring
        var d = new Date(datestr);
        // get timestamp and add timezone
        // <?php // d = new Date( d.getTime() + <?=$this->timezone->getOffset( $this->dateValue )?> ); ?>
        // use built-in date formatter
        s.value = d.getFullYear() 
            + '-' + (d.getMonth() + 1)
            + '-' + (d.getDate());
        if( d.getHours() && d.getMinutes() )
            s.value += ' ' + d.getHours() + ':' + d.getMinutes();

<?php else: ?>
        s.value = datestr;
<?php endif ?>
        if( window.console ) console.log(s.value);
    }
    for( var c in columns ) {
        var id = columns[c];
        document.getElementById(id).addEventListener('change',updater,false);
    }
})();
</script>
<?php
        $script = ob_get_contents();
        ob_end_clean();
        return parent::render() . $this->renderNodes($nodes) . $script;
        /*
        $yearS = new SelectInput(array(
            'options' => $this->year_range,
        ));
        $yearS->addId( $yearId = $this->getSerialId() );

        $monthS = new SelectInput(array(
            'options' => $this->month_range
        ));
        $monthS->addId( $monthId = $this->getSerialId() );

        $dayS = new SelectInput(array(
            'options' => $this->day_range
        ));
        $dayS->addId( $dayId = $this->getSerialId() );

        spl_autoload_call('FormKit\ResponseUtils');
        block_start(); ?>
        <script>

        </script>
        <?php $html = block_end();

        $this->append($yearS);
        $this->append($monthS);
        $this->append($dayS);
        return parent::render( $attributes ) . $html;
        */
    }
}






