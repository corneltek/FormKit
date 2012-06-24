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

    public function render( $attributes = array() )
    {
        $yearS = new SelectInput(array(
            'options' => range(2000,2012)
        ));
        $yearS->addId( $yearId = $this->getSerialId() );

        $monthS = new SelectInput(array(
            'options' => range(1,12)
        ));
        $monthS->addId( $monthId = $this->getSerialId() );

        $dayS = new SelectInput(array(
            'options' => range(1,31)
        ));
        $dayS->addId( $dayId = $this->getSerialId() );

        spl_autoload_call('FormKit\ResponseUtils');

        block_start(); ?>

        <?php block_end();

        $this->append($yearS);
        $this->append($monthS);
        $this->append($dayS);
        return parent::render( $attributes );
    }
}






