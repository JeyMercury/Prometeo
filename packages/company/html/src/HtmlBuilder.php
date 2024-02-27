<?php

namespace Company\Html;

use Collective\Html\HtmlBuilder as HtmlBuilderParent;

class HtmlBuilder extends HtmlBuilderParent
{
    /**
     * Generate a HTML link.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $secure
     * @param bool   $escape
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function link($url, $title = null, $attributes = [], $secure = null, $escape = true){
        $defaults = array('escape' => true);

        $attributes = $attributes + $defaults;

        $url = $this->url->to($url, [], $secure);

        if(is_null($title) || $title === false){
            $title = $url;
        }
        if(isset($attributes['escape']) && $attributes['escape']){
            $title = $this->entities($title);
        }
        unset($attributes['escape']);

        return $this->toHtmlString('<a href="' . $url . '"' . $this->attributes($attributes) . '>' . $title . '</a>');
    }

    public function icon($name, $style = ''){
        return '<i class="'.$name.'" style="'.$style.'"></i>';
    }

    public function image($url, $alt = null, $attributes = [], $secure = null){
        if(!isset($attributes['loading'])){
            $attributes['loading'] = "lazy";
        }
        if(!isset($attributes['onerror'])){
            $attributes['onerror'] ="this.src='/img/image_default.svg'";
        }
        return parent::image($url, $alt, $attributes, $secure);
    }
}
