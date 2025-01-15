<?php

namespace Letscms\BuyNowBtn\Block;

class Colorpicker extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * [_getElementHtml used to get color from color picker and show RGB values]
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = $element->getElementHtml();
        $value = $element->getData('value');

        // Add an additional input field to display the RGB values
        $html .= '<input type="text" id="' . $element->getHtmlId() . '_rgb" readonly style="margin-left: 10px; width: 120px;" placeholder="RGB">';

        $html .= '<script type="text/javascript">
            require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                $(document).ready(function () {
                    var thisElement = $("#' . $element->getHtmlId() . '");
                    var rgbElement = $("#' . $element->getHtmlId() . '_rgb");

                    // Set initial color and RGB value
                    thisElement.css("backgroundColor", "'. $value .'");
                    updateRGB("' . $value . '");

                    thisElement.ColorPicker({
                        color: "'. $value .'",
                        onChange: function (hsb, hex, rgb) {
                            thisElement.css("backgroundColor", "#" + hex).val("#" + hex);
                            updateRGB("#" + hex);
                        }
                    });

                    // Function to convert hex to RGB and update the RGB field
                    function updateRGB(hex) {
                        var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                        hex = hex.replace(shorthandRegex, function(m, r, g, b) {
                            return r + r + g + g + b + b;
                        });
                        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                        if (result) {
                            var r = parseInt(result[1], 16);
                            var g = parseInt(result[2], 16);
                            var b = parseInt(result[3], 16);
                            rgbElement.val("RGB(" + r + ", " + g + ", " + b + ")");
                        }
                    }
                });
            });
        </script>';
        
        return $html;
    }
}
