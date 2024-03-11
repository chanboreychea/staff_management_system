



<div class="table-responsive-sm"  style="overflow-x: auto;">

    <table class="table table-bordered">
    @if($workingHistoryPublicSector->isEmpty())
            <!-- If $workingHistoryPublicSector is empty, don't display the <thead> section -->
        @else
           
            <thead>
            
                <tr>
                
                    <th>ថ្ងៃ-ខែ​​​-ឆ្នាំ​ ចូល</th>
                    
                    <th class="text-sm">ថ្ងៃ-ខែ​​​-ឆ្នាំ ចេញ</th>
                    
                    <th class="text-sm">ក្រសួង/ស្ថាប័ន</th>
                    
                    <th class="text-sm">អង្គភាព</th>
                    
                    <th class="text-sm">មុខតំណែង</th>
                    
                    <th class="text-sm">ផ្សេងៗ</th>
                
                </tr>
    
            </thead>
        
        @endif

        <tbody>
           
            @foreach ($workingHistoryPublicSector as $index => $working_histroy_public_sector)
            
                <tr class="additon_current_job">
                    <td>
                    
                    <input type="hidden" value="{{ $working_histroy_public_sector['id']}}" name="id[]">

                    <input  type="date" 
                                      
                                name="start_date[]" 
                                
                                value="{{ $working_histroy_public_sector['start_date'] ?? old('start_date.' . $index) }}"
                                
                                class="form-control-sm form-control"

                                required
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">    
                    
                    </td>
                    <td>
                        
                        <input type="date" class="form-control form-control-sm" 
                        
                         name="end_date[]" 
                        
                        required value="{{ $working_histroy_public_sector['end_date'] ?? old('end_date.' . $index) }}">
                    
                    </td>
                    
                    <td>
                    
                        <!-- <input type="text" class="form-control form-control-sm" id="textInput" 
                        
                        placeholder="ក្រសួង/ស្ថាប័ន" name="ministry[]" 
                        
                        required value="{{ $working_histroy_public_sector['ministry'] ?? old('ministry.' . $index) }}">
                      
                            <input type="text" id="textInput" placeholder="Hover over me">
                            <textarea id="textareaInput" placeholder="Textarea"></textarea> -->
                            <div class="container">
                            <input type="text" class="form-control form-control-sm" id="textInput" 
                                placeholder="ក្រសួង/ស្ថាប័ន" name="ministry[]" 
                                id="hoverTextInput" 
                                required value="{{ $working_histroy_public_sector['ministry'] ?? old('ministry.' . $index) }}">
                           
                            
                            <!-- <textarea id="textareaInput" class="shadow-sm p-3 mb-5 bg-white rounded" placeholder="បញ្ចូល"></textarea> -->
                            </div>
                    </td>
                    
                    <td>
                        <div class="container">

                            <input type="text" class="form-control form-control-sm" 
                        
                            placeholder="អង្គភាព" name="economy[]" 

                            id="textInput2"
                            
                            required value="{{ $working_histroy_public_sector['economy'] ?? old('economy.' . $index) }}">
                        
                            <!-- <textarea id="textareaInput2" class="shadow-sm p-3 mb-5 bg-white rounded" placeholder="បញ្ចូល"></textarea> -->
                        
                        </div>
                    </td>
                    
                    <td style=" vertical-align: middle;">

                        <div class="container">
                           
                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="មុខតំណែង" name="position[]" 
                            
                            required value="{{ $working_histroy_public_sector['position'] ?? old('position.' . $index) }}">
                        
                        </div>

                    </td>

                    <td  style=" vertical-align: middle;">
                        <div class="container">
                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="ផ្សេងៗ" name="other[]" 
                            
                            required value="{{ $working_histroy_public_sector['other'] ?? old('other.' . $index) }}">
                        </div>         
                    </td>
                
                </tr>
  
            @endforeach
        
        </tbody>
    
    </table>
</div>
<style>
    .container {
      /* margin: 50px auto; */
      width: 250px;
    }
/* 
    textarea {
      display: none;
      width: 100%;
      margin-top: 10px;
      resize: none;
      border:none;
    }
    textarea:focus {
      outline:none;
    } */
  </style>
<script>
    $(document).ready(function() {
      var $textInput = $("#textInput");
      var $textareaInput = $("#textareaInput");

      $(".container").hover(
        function() {
          $textareaInput.show();
        },
        function() {
          if (!$textareaInput.is(":focus")) {
            $textareaInput.hide();
          }
        }
      );

      $textareaInput.on("input", function() {
        $textInput.val($(this).val());
      });

      $textareaInput.on("blur", function() {
        if (!$textInput.is(":focus")) {
          $(this).hide();
        }
      });
    });
    // $(document).ready(function() {
    //   var $textInput2 = $("#textInput2");
    //   var $textareaInput2 = $("#textareaInput2");

    //   $(".container").hover(
    //     function() {
    //       $textareaInput2.show();
    //     },
    //     function() {
    //       if (!$textareaInput2.is(":focus")) {
    //         $textareaInput2.hide();
    //       }
    //     }
    //   );

    //   $textareaInput2.on("input", function() {
    //     $textInput2.val($(this).val());
    //   });

    //   $textareaInput2.on("blur", function() {
    //     if (!$textInput2.is(":focus")) {
    //       $(this).hide();
    //     }
    //   });
    // });
  </script>