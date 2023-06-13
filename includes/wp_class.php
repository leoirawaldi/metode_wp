<?php
class WP
{
    public $bobot;

    public $data;
    public $atribut;

    public $bobot_normal;
    public $minmax;
    public $normal;
    public $terbobot;
    public $total;

    function __construct($data, $atribut, $bobot)
    {
        $this->data = $data;
        $this->atribut = $atribut;
        $this->bobot = $bobot;

        $this->bobot_normal();
        $this->bobot_pangkat();
        $this->normal();
        $this->vektor_s();
        $this->vektor_v();
    }
    function vektor_v()
    {
        foreach ($this->vektor_s as $key => $val) {
            $this->vektor_v[$key] = $val / array_sum($this->vektor_s);
        }
    }
    function vektor_s()
    {
        foreach ($this->normal as $key => $val) {
            $this->vektor_s[$key] = 1;
            foreach ($val as $k => $v) {
                $this->vektor_s[$key] *= $v;
            }
        }
    }
    function normal()
    {
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $this->normal[$key][$k] = pow($v, $this->bobot_pangkat[$k]);
            }
        }
    }
    function bobot_pangkat()
    {
        foreach ($this->bobot_normal as $key => $val) {
            $this->bobot_pangkat[$key] = strtolower($this->atribut[$key]) == 'benefit' ? $val : -$val;
        }
    }
    function bobot_normal()
    {
        $total = array_sum($this->bobot);
        foreach ($this->bobot as $key => $val) {
            $this->bobot_normal[$key] = $val / $total;
        }
    }
}
