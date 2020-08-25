<?php

namespace equilibre;

class Cart
{
   public  $items = null;
   public  $totalQty = 0;
   public  $preciototal = 0;
   public  $precioiva = 0;
   public  $preciofinal = 0;

   private $iva = 0.19;

   public function __construct($oldCart)
   {
       if ($oldCart)
       {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->preciototal = $oldCart->preciototal;
            $this->precioiva = $oldCart->precioiva;
            $this->preciofinal = $oldCart->preciofinal;
       }
   }

   public function add($item, $id){
       $storedItem = ['qty' => 0, 'precio_unitario' => $item->precio_descuento, 'precio' => $item->precio_descuento, 'item' => $item];
       if ($this->items){
            if (array_key_exists($id, $this->items)){
               $storedItem = $this->items[$id];
            } 
       }
       $storedItem['qty']++;
       $storedItem['precio'] = $item->precio_descuento * $storedItem['qty'];
       $this->items[$id] = $storedItem;
       $this->totalQty++;
       $this->preciototal += $item->precio_descuento;
       $this->precioiva = $this->preciototal*$this->iva;
       $this->preciofinal = $this->preciototal*(1+$this->iva); 
       //dd($this);
   }

   
   public function remove($id,$total) {
        $this->items[$id]['qty']--;
        $this->items[$id]['precio'] = $this->items[$id]['precio']-$this->items[$id]['precio_unitario'];
        $this->totalQty--;

        $this->preciototal = $total-$this->items[$id]['precio_unitario'];
        $this->precioiva = $this->preciototal*$this->iva;
        $this->preciofinal = $this->preciototal*(1+$this->iva); 
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
        //dd($this);
    }

    public function removeAll($id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->preciototal -= $this->items[$id]['precio'];
        $this->precioiva = $this->preciototal*$this->iva;
        $this->preciofinal = $this->preciototal*(1+$this->iva); 
        unset($this->items[$id]);
        //dd($this);
    }
}