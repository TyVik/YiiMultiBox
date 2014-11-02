<?php
/**
 * YiiMultiBox class file.
 *
 * PHP Version 5.1
 *
 * @category Vencidi
 * @package  Widget
 * @author   TyVik <tyvik8@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://www.vencidi.com/ Vencidi
 * @since    3.0
 */
Yii::import('zii.widgets.jui.CJuiWidget');
/**
 * YiiMultiBox Creates Multiple Draggable Boxes
 *
 * @category Vencidi
 * @package  Widget
 * @author   TyVik <tyvik8@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @version  Release: 1.0
 * @link     http://www.vencidi.com/ Vencidi
 * @since    3.0
 */
class YiiMultiBox extends CJuiWidget
{
    public $boxes;
    public $form;

    /**
     * Run not used...
     *
     * @return void
     */
    function run()
    {

    }

    /**
     * Initializes everything
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->registerScripts();
    }

    /**
     * Registers the JS and CSS Files
     *
     * @return void
     */
    protected function registerScripts()
    {
        parent::registerCoreScripts();
        $basePath=Yii::getPathOfAlias('application.widget.yiimultibox.assets');
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath);

        $cs=Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . DIRECTORY_SEPARATOR . 'lists.css');

        $this->scriptUrl=$baseUrl;
        $this->registerScriptFile('ui.yiimultibox.js');
        $this->registerScriptFile('dragdrop.js');
        $this->registerScriptFile('drag.js');
        $this->registerScriptFile('coordinates.js');

        foreach ($this->boxes as $name => $box) {
            $header = '';
            if (array_key_exists('header', $box)) {
                $header = CHtml::tag('lh', array(), $box['header'], true);
            }

            $elements = '';
            foreach ($box['data'] as $key => $value) {
                $htmlOptions = (isset($value["htmlOptions"])) ? $value["htmlOptions"] : array();
                $content = $value['name'];
                unset($value['name']);
                $htmlOptions['id'] = $key;
                $elements .= CHtml::tag('li', $htmlOptions, $content, true);
            }

            $htmlOptions = array("class" => "", "id" =>$name);
            if (isset($box["htmlOptions"])) {
                $htmlOptions = array_merge($htmlOptions, $box["htmlOptions"]);
            }
            $htmlOptions["class"] .= " sortable boxy";
            echo CHtml::tag('ul', $htmlOptions, $header.$elements, true);
        }
        echo CHtml::hiddenField("YiiMultiBox", "", array('id' => "YiiMultiBox"));

        Yii::app()->clientScript->registerScript(
            'EMultiSelect',
            'window.onload = function() {
makeDraggable();
attachToForm("'.$this->form.'");
};',
            CClientScript::POS_READY
        );

    }
}
?>
