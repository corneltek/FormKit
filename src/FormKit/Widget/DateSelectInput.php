<?php
namespace FormKit\Widget;
use FormKit\Widget\SelectInput;
use FormKit\ResponseUtils;
use DateTime;

class DateSelectInput extends HiddenInput
{
    public $start_year;
    public $end_year;
    public $formatOptions = array();

    public function init() 
    {
        parent::init();

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

        foreach( range(1,31) as $d )
            $this->formatOptions['d'][ sprintf('%02d',$d) ] = sprintf('%02d',$d);
    }

    public function inflateDate($date)
    {
        if( is_object($date) ) 
            return $date->format('Y-m-d');
        if( is_numeric($date) )
            return date('Y-m-d',(int)$date);
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
                $select = new SelectInput(array(
                    'options' => $this->formatOptions[$c],
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
        if( window.console )
            console.log(datestr);
        s.value = datestr;
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






