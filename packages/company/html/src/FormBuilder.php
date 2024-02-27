<?php

namespace Company\Html;

use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Collective\Html\FormBuilder as FormBuilderParent;
use Illuminate\Support\MessageBag;

class FormBuilder extends FormBuilderParent{
    function __construct(HtmlBuilder $html, UrlGenerator $url, Factory $view, $csrfToken, Request $request = null){
        $this->errors = (session('errors'))?session('errors'):new MessageBag;

        parent::__construct($html, $url, $view, $csrfToken, $request);
    }

    /**
     * Create a form label element.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     * @param  bool $escape_html
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function label($name, $value = null, $options = [], $escape_html = true){
        if(!empty($name) && $this->errors->has($name)){
            $options['class'] = (isset($options['class'])?$options['class']:'') . ' is-invalid-label';
        }

        return parent::label($name, $value, $options, $escape_html);
    }


    /**
     * Create a form input field with label.
     *
     * @param  string $type
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function input($type, $name, $value = null, $options = []){
        $html = '';
        if(!empty($name) && $this->errors->has($name)){
            $options['class'] = (isset($options['class'])?$options['class']:'') . ' is-invalid-input';
            ob_start();
            echo "<span class=\"form-error is-visible\">";
            echo $this->errors->first($name);
            echo "</span>";
            $html = ob_get_contents();
            ob_end_clean();
        }

        $old_name = $name;
        $name = preg_replace('/\./', '[', $name, 1);
        $name = str_replace('.', '][', $name);

        if($name != $old_name){
            $name.=']';
        }

        $label = $this->insert_label($name, $options, $type);
        $input = parent::input($type, $name, $value, $options);

        return $this->toHtmlString($label . $input->toHtml() . $html);

    }

    /**
     * Create a textarea input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function textarea($name, $value = null, $options = []){
        $html = '';
        if(!empty($name) && $this->errors->has($name)){
            $options['class'] = (isset($options['class'])?$options['class']:'') . ' is-invalid-input';
            ob_start();
            echo "<span class=\"form-error is-visible\">";
            echo $this->errors->first($name);
            echo "</span>";
            $html = ob_get_contents();
            ob_end_clean();
        }

        $old_name = $name;
        $name = preg_replace('/\./', '[', $name, 1);
        $name = str_replace('.', '][', $name);

        if($name != $old_name){
            $name.=']';
        }

        $label = $this->insert_label($name, $options);

        $textarea = parent::textarea($name, $value, $options);
        return $this->toHtmlString($label . $textarea->toHtml() . $html);
    }



    /**
     * Create a select box field.
     *
     * @param  string $name
     * @param  array $list
     * @param  string $selected
     * @param  array $selectAttributes
     * @param  array $optionsAttributes
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function select($name, $list = [], $selected = null, array $selectAttributes = [], array $optionsAttributes = [], array $optgroupsAttributes = []){
        $html = '';
        if(!empty($name) && $this->errors->has($name)){
            $selectAttributes['class'] = (isset($selectAttributes['class'])?$selectAttributes['class']:'') . ' is-invalid-input';
            ob_start();
            echo "<span class=\"form-error is-visible\">";
            echo $this->errors->first($name);
            echo "</span>";
            $html = ob_get_contents();
            ob_end_clean();
        }

        $old_name = $name;
        $name = preg_replace('/\./', '[', $name, 1);
        $name = str_replace('.', '][', $name);

        if($name != $old_name){
            $name.=']';
        }

        if(isset($selectAttributes['empty']) && $selectAttributes['empty']){
            $selectAttributes['placeholder'] = '';
        }

        $label = $this->insert_label($name, $selectAttributes);


        $select = parent::select($name, $list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes);
        return $this->toHtmlString($label . $select->toHtml() . $html);
    }

    /**
     * Create a checkbox input field.
     *
     * @param  string $name
     * @param  mixed $value
     * @param  bool $checked
     * @param  array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function checkbox($name, $value = 1, $checked = null, $options = []){

        $current_value = $this->getValueAttribute($name, $checked);
        if(!isset($current_value) && !empty($options['default'])){
            $checked = $options['default'];
        }
        if(!isset($options['hiddenFalse']) || $options['hiddenFalse']){
            $hiddenFalse = "<input type=\"hidden\" name=\"" . $name . "\" value=\"0\">";
        }else{
            $hiddenFalse = "";
        }
        $div_checkbox = '<div class="div-checkbox">';
        $fin_div_checkbox = '</div>';


        $old_name = $name;
        $name = preg_replace('/\./', '[', $name, 1);
        $name = str_replace('.', '][', $name);

        if($name != $old_name){
            $name.=']';
        }


        $checkbox = parent::checkbox($name, $value, $checked, $options);
        return $this->toHtmlString($hiddenFalse . $div_checkbox . $checkbox->toHtml() . $fin_div_checkbox);
    }



    /**
     * Insert label con forms field
     *
     * @param  string $name
     * @param  array $options
     * @param  string $type
     *
     * @return \Illuminate\Support\HtmlString
     */

    public function insert_label($name, &$options = [], $type = null){
        $label = '';
        if(!isset($type) || $type != 'hidden'){
            if(!isset($options['id'])){
                $options['id'] = $name;
            }
            if(!isset($options['label'])){
                $options['label'] = str_replace('_', ' ', ucfirst(strtolower($name)));
            }
            if($options['label']){
                $label = parent::label($options['id'], $options['label']);
            }
        }

        return $label;
    }
}
