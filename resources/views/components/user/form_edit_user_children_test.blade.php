<div class="table-responsive-sm" style="overflow-x: auto;">

    <!-- <table id="example1"  class="display nowrap table table-bordered"> -->
    <table id="example" class="display table  table-bordered" style="width:100%">

        <tbody>
          
        @if(!is_null($userFamily))

            <?php
                // Unserialize each property and count its elements
                $children_name = unserialize($userFamily->children_name);
                $count_children_name = is_array($children_name) ? count($children_name) : 0;

                $children_name_in_english = unserialize($userFamily->children_name_in_english);
                $count_children_name_in_english = is_array($children_name_in_english) ? count($children_name_in_english) : 0;

                $children_gender = unserialize($userFamily->children_gender);
                $count_children_gender = is_array($children_gender) ? count($children_gender) : 0;

                $children_job = unserialize($userFamily->children_job);
                $count_children_job = is_array($children_job) ? count($children_job) : 0;

                $children_allowance = unserialize($userFamily->children_allowance);
                $count_children_allowance = is_array($children_allowance) ? count($children_allowance) : 0;

                $children_date = unserialize($userFamily->children_date);
                $count_children_date = is_array($children_date) ? count($children_date) : 0;

                // Store counts in an array
                $counts = [
                    $count_children_name,
                    $count_children_name_in_english,
                    $count_children_gender,
                    $count_children_job,
                    $count_children_allowance,
                    $count_children_date
                ];

                // Find the maximum count
                $max_count = max($counts);
            ?>
           
            @if ($max_count>0)
                
            @else
                {{'hello'}}
            @endif
      
                
        @endif
        
        </tbody>
    
    </table>
  
</div>
<style>
    .width{
        width: 250px;
    }
</style>
