<?php
namespace FormKit\Widget;
use FormKit\Widget\SelectInput;
use FormKit\ResponseUtils;


/**
 * TODO: not implemented
 *
 * DateSelectInput widget with pure Select widget
 *
 *     $selector = new DateSelectInput([
 *         'name' => 'date',
 *         'year_range' => range(2010,2012),
 *         'value' => '2012-12-12',
 *         'format' => 'yy-mm-dd',   // which means yy format in year selector, mm in month selector, dd in day selector.
 *     ]);
 *
 */
class DateSelectInput extends HiddenInput
{

    public $year_range = array();
    public $month_range = array();
    public $day_range = array();

    public function init() {
        parent::init();
        $this->year_range = range(2000,2012);
        $this->month_range = range(1,12);
        $this->day_range = range(1,31);
    }

    public function render( $attributes = array() )
    {
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
    }
}






