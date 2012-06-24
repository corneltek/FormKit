<?php
namespace FormKit\Widget;
use FormKit\Widget\SelectInput;
use FormKit\ResponseUtils;

class DateSelectInput extends TextInput
{
    public $type = 'hidden';
    public $class = array('formkit-widget','formkit-widget-date');

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






