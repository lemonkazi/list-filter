@if ($paginator->hasPages())
<div class="row">
    <div class="col-sm-12 col-md-5">

      <?php
      // Total number of results
      $total = $totalTalent;

      // Items per page
      $item_per_page = $paginator->count();

      // Page number
      $page_number = $paginator->currentPage();

      // break records into pages
      $total_pages = count($elements);

      // get starting position to fetch the records
      $page_position = (($page_number - 1) * $item_per_page) + 1;


      // And for last page, there's sometimes the count of records not equal to the $item_per_page, so you should directly show the $total.
      if ($page_number == $total_pages) {
        $pagination_string =  $page_position . ' to ' . $total . ' of ' . $total;
      } 
      else {
        if ($page_number ==1) {
          $pagination_string =  $page_position . ' to ' . $item_per_page . ' of ' . $total;
        } else {
          $pagination_string =  $page_position . ' to ' . ($page_position + $item_per_page-1) . ' of ' . $total;

        }
      }

      ?>
      <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing {{ $pagination_string }} </div>
   </div>
   <div class="col-sm-12 col-md-7 dataTables_wrapper">
      <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
         <!-- <ul class="pagination">
            <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
            <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
            <li class="paginate_button page-item disabled" id="example1_ellipsis"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">…</a></li>
            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">44</a></li>
            <li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="8" tabindex="0" class="page-link">Next</a></li>
         </ul> -->

          <ul class="pagination">
    
            @if ($paginator->onFirstPage())
              <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
            @else
              <li class="paginate_button page-item previous" id="example1_previous"><a href="{{ $paginator->previousPageUrl() }}" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                
            @endif
        
        
                @foreach ($elements as $element)

                    @if (is_string($element))
                        <li class="page-item disabled"><a  class="page-link" href="#">{{ $element }}</a></li>
                        
                    @endif


                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                              <li class="active page-item"><a  class="page-link" href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            

        
            @if ($paginator->hasMorePages())
              <li class="paginate_button page-item next" id="example1_next"><a href="{{ $paginator->nextPageUrl() }}" aria-controls="example1" data-dt-idx="8" tabindex="0" class="page-link">Next</a></li>
            @else
              <li class="paginate_button page-item next disabled" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="8" tabindex="0" class="page-link">Next</a></li>
            @endif
        
   
          </ul>
      </div>
   </div>
</div>





@endif 


<!-- <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
      <li class="page-item"><a class="page-link" href="#">«</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">»</a></li>
    </ul>
  </div> -->