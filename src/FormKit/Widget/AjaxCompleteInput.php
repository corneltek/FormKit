<?php
namespace FormKit\Widget;

/**
 * $ajax = new AjaxCompleteInput( 'name' , array( 
 *     'source' => 'ajax_complete.php',
 *     'min_length' => 2,
 * ));
 */
class AjaxCompleteInput extends TextInput
{

    public $class = array('formkit-widget','formkit-text','formkit-ajax-complete');

    public $source;

    public $min_length = 1;

    public function render( $attributes = array() )
    {
        $serial =  $this->getSerial();
        $this->addId( $serial );
        ob_start();
        /*
            <style>
            .ui-autocomplete-loading { 
                background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
            }
            </style>
            select: function( event, ui ) {
                log( ui.item ?
                    "Selected: " + ui.item.value + " aka " + ui.item.id :
                    "Nothing selected, input was " + this.value );
            }
        */
        ?>
    <script>
    jQuery(function() {
        jQuery( "#<?= $serial ?>" ).autocomplete({
            source: "<?= $this->source ?>",
            minLength: <?= $this->min_length ?>
        });
    });
    </script>
        <?php
        $script = ob_get_contents();
        ob_end_clean();
        return parent::render( $attributes ) . $script;
    }

}


