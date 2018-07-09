<?php
namespace Mobtexting;

class Voice
{
    protected $elements = [];

    public function __construct($arg = null)
    {
    }

    public function __call($verb, array $args)
    {
        return $this->widget($verb, $args);
    }

    public function widget($verb, $args = [])
    {
        $widget = 'Mobtexting\\Voice\\Tag\\'.ucfirst(strtolower($verb));

        $widget = new $widget(...$args);

        $this->elements[] = $widget;

        return $widget;
    }
 
    public function toArray()
    {
        $results = [];
        foreach ($this->elements as $element) {
            $results[] = $element->toArray();
        }

        return $results;
    }

    public function toJson()
    {
        return \json_encode($this->toArray());
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
