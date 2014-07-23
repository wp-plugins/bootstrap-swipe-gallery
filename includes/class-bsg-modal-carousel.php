<?php

// Builds and echoes a modal carousel for each gallery 
class BSG_Modal_Carousel {

  private $gallery_id ;
  private $carousel_inner_items ;
  private $image_indicators ;
  private $slide_to_index ;
  private $image_src_full_size ;
  private static $instance_id = 1 ;                                                                                                                  
  
  function __construct() {
    $this->gallery_id = 'gallery-' . self::$instance_id ;
    $this->carousel_inner_items  = '' ;
    $this->image_indicators = '' ;
    $this->slide_to_index = 0 ;
    self::$instance_id++;       
  }
    
  public function add_image( $image_src_full_size ) {
    $this->append_image_to_inner_items( $image_src_full_size ) ; 
    $this->append_to_carousel_indicators( $image_src_full_size ) ;
  }
  
  private function append_image_to_inner_items( $image_src_full_size ) {
    $is_active = (0 == $this->slide_to_index ) ? 'active' : '' ;

    $this->carousel_inner_items .= 
    "<div class='item {$is_active}'>
      <img src='{$image_src_full_size}'>
    </div> \n" ;
  }

  private function append_to_carousel_indicators( $image_src_full_size ){
    $is_active = (0 == $this->slide_to_index ) ? 'active' : '' ;
    
    $this->image_indicators .= 
    "<li class='{$is_active}' data-target='#carousel-{$this->gallery_id}' data-slide-to='{$this->slide_to_index}' data-src='{$image_src_full_size}'></li>" ;
    $this->slide_to_index++ ;
  }

  public function get() {
    return 
    "<div id='carousel-{$this->gallery_id}' class='gallery-modal modal fade'>
       <div class='modal-dialog modal-lg'>
	 <div class='modal-content modal-content-gallery'>
	   <div class='modal-header'>  
	     <a data-dismiss='modal' aria-hidden='true' href='#'>
	       <span class='glyphicon glyphicon-remove-circle'></span>
	     </a>
	   </div>\n
	   <div class='modal-body'>
	     <div id='carousel-{$this->gallery_id}' class='carousel slide carousel-gallery'>   
	       <div class='carousel-inner'> 
		 {$this->carousel_inner_items}
	       </div>
	       <ol class='carousel-indicators'> 
		 {$this->image_indicators}
	       </ol>	       
	       <a class='left carousel-control' href='#carousel-{$this->gallery_id}' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a>
	       <a class='right carousel-control' href='#carousel-{$this->gallery_id}' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a> 
	     </div>  <!-- .carousel --> 
           </div> <!-- .modal-body -->
         </div> <!-- .modal-content -->
       </div> <!-- .modal-dialog -->
     </div> <!-- .gallery-modal --> \n"  ;
  }
}