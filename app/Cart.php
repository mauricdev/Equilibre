<?php

namespace equilibre;

class Cart
{
   public  $items = null;
   public  $totalQty = 0;
   public  $preciototal = 0;

   public function __construct($oldCart)
   {
       if ($oldCart)
       {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->preciototal = $oldCart->preciototal;
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
   }

   
   public function remove($id,$total) {
        $this->items[$id]['qty']--;
        $this->items[$id]['precio'] = $this->items[$id]['precio']-$this->items[$id]['precio_unitario'];
        $this->totalQty--;

        $this->preciototal = $total-$this->items[$id]['precio_unitario'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function removeAll($id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->preciototal -= $this->items[$id]['precio'];
        unset($this->items[$id]);
    }
}