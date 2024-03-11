<!-- @if (!empty($user_information['position_additional_position_on_current_job']))
    @php
        $positions = unserialize($user_information['position_additional_position_on_current_job']);
    @endphp

    @if (is_array($positions))
        @foreach ($positions as $key => $position)
            <div class="form-group col-md-6">
                <label>មុខតំណែង</label>
                <input type="text" class="form-control" placeholder="មុខតំណែង" name="position_additional_position_on_current_job[]"
                    required value="{{ $position ?? old('position_additional_position_on_current_job.'.$key) }}">
            </div>
        @endforeach
    @endif
@endif

@if (!empty($user_information['equivalent']))
    @php
        $equivalents = unserialize($user_information['equivalent']);
    @endphp

    @if (is_array($equivalents))
        @foreach ($equivalents as $key => $equivalent)
            <div class="form-group col-md-6">
                <label>មុខតំណែង</label>
                <input type="text" class="form-control" placeholder="មុខតំណែង" name="equivalent[]"
                    required value="{{ $equivalent ?? old('equivalent.'.$key) }}">
            </div>
        @endforeach
    @endif
@endif

@if (!empty($user_information['economy']))
    @php
        $economies = unserialize($user_information['economy']);
    @endphp

    @if (is_array($econoies))
        @foreach ($economies as $key => $economy)
            <div class="form-group col-md-6">
                <label>មុខតំណែង</label>
                <input type="text" class="form-control" placeholder="មុខតំណែង" name="economy_additional_position_on_current_job[]"
                    required value="{{ $economy ?? old('economy_additional_position_on_current_job.'.$key) }}">
            </div>
        @endforeach
    @endif
@endif -->
<!-- ------------------- -->

<!-- @php
    $sections = [
        'position_additional_position_on_current_job' => 'មុខតំណែង',
        'equivalent' => 'មុខតំណែង',
        'economy' => 'អង្គភាព'
    ];
@endphp

@foreach ($sections as $sectionKey => $sectionLabel)
    @if (!empty($user_information[$sectionKey]))
        @php
            $data = unserialize($user_information[$sectionKey]);
        @endphp

        @if (is_array($data))
            @foreach ($data as $key => $value)
                <div class="form-group col-md-6">
                    <label>{{ $sectionLabel }}</label>
                    <input type="text" class="form-control" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                        required value="{{ $value ?? old($sectionKey.'.'.$key) }}">
                </div>
            @endforeach
        @endif
    @endif
@endforeach -->
<div class=" table-responsive-sm">

    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- <th>ល.រ</th>
                <th>ថ្ងៃខែឆ្នាំ</th> -->
                <!-- <th>ល.រ</th> -->
            
                <th>មុខតំណែង</th>
                <th>ឋានៈស្មើ</th>
                <th>អង្គភាព</th>
                <th>ឯកសារ</th>
            </tr>
        </thead>
        <!-- <tbody>
            @php
                $sections = [
                    'position_additional_position_on_current_job' => 'មុខតំណែង',
                    'equivalent' => 'ឋានៈស្មើ',
                    'economy_additional_position_on_current_job' => 'អង្គភាព'
                ];
                $counter = 1;
            @endphp

            @foreach ($sections as $sectionKey => $sectionLabel)
                @if (!empty($user_information[$sectionKey]))
                    @php
                        $data = unserialize($user_information[$sectionKey]);
                    @endphp

                    @if (is_array($data))
                        @foreach ($data as $key => $value)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    @if($sectionKey=='equivalent')
                                        <input type="text" class="form-control form-control-sm" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                        required value="{{ $value ?? old($sectionKey.'.'.$key) }}">
                                    @endif
                                </td>
                                <td>
                                    @if($sectionKey=='position_additional_position_on_current_job')
                                        <input type="text" class="form-control form-control-sm" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                        required value="{{ $value ?? old($sectionKey.'.'.$key) }}">
                                    @endif
                                </td>
                    
                                <td>
                                    @if($sectionKey=='economy_additional_position_on_current_job')
                                        <input type="text" class="form-control form-control-sm" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                        required value="{{ $value ?? old($sectionKey.'.'.$key) }}">
                                    @endif

                                </td>
                                <td></td>

                            </tr>
                        @endforeach
                    @endif
                @endif
            @endforeach
        </tbody> -->
        <tbody>
            @php
                $sections = [
                    'position_additional_position_on_current_job' => 'មុខតំណែង',
                    'equivalent' => 'ឋានៈស្មើ',
                    'economy_additional_position_on_current_job' => 'អង្គភាព',
                    'document'=>'ឯកសារ',
                ];
                $maxRowCount = 0;

                // Calculate the maximum number of rows among all sections
                foreach ($sections as $sectionKey => $sectionLabel) {
                    if (!empty($user_information[$sectionKey])) {
                        $data = unserialize($user_information[$sectionKey]);
                        if (is_array($data) && count($data) > $maxRowCount) {
                            $maxRowCount = count($data);
                        }
                    }
                }
            @endphp

            @for ($rowIndex = 0; $rowIndex < $maxRowCount; $rowIndex++)
                <tr>
                    @foreach ($sections as $sectionKey => $sectionLabel)
                        @if (!empty($user_information[$sectionKey]))
                            @php
                                $data = unserialize($user_information[$sectionKey]);
                                $value = isset($data[$rowIndex]) ? $data[$rowIndex] : null;
                            @endphp
                        
                            <td>
                                @if($sectionKey == 'equivalent')
                                    <input type="text" class="form-control form-control-sm" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                        required value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">
                                @elseif($sectionKey == 'position_additional_position_on_current_job')
                                    <input type="text" class="form-control form-control-sm" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                        required value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">
                                @elseif($sectionKey == 'economy_additional_position_on_current_job')
                                    <input type="text" class="form-control form-control-sm" placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                        required value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">
                            @elseif ($sectionKey == 'document' && $value)
                                <a href="{{ asset('documents/' . $value) }}" target="_blank">hello</a> 
                            @endif

                            </td>
                        @else
                            <td></td> <!-- Empty cell if the section is empty -->
                        @endif
                    @endforeach
                </tr>
            @endfor
        </tbody>

    </table>

</div>

----------------------------------------------------------------


<div class=" table-responsive-sm">

    <table class="table table-bordered" >

        <thead >
            
            <tr >
            
                <th>មុខតំណែង</th>
                
                <th>ឋានៈស្មើ</th>
                
                <th>អង្គភាព</th>
                
                <th>ឯកសារ</th>
            
            </tr>
        
        </thead>
        
        <tbody>
        
            @php
            
                $sections = [
                
                    'position_additional_position_on_current_job' => 'មុខតំណែង',
                
                    'equivalent' => 'ឋានៈស្មើ',
                
                    'economy_additional_position_on_current_job' => 'អង្គភាព',
                
                    'document'=>'ឯកសារ',
                ];
                
                $maxRowCount = 0;

                // Calculate the maximum number of rows among all sections
                
                foreach ($sections as $sectionKey => $sectionLabel) {
                
                    if (!empty($user_information[$sectionKey])) {
                
                        $data = unserialize($user_information[$sectionKey]);
                
                        if (is_array($data) && count($data) > $maxRowCount) {
                
                            $maxRowCount = count($data);
                        }
                    }
                }
            
            @endphp

            @for ($rowIndex = 0; $rowIndex < $maxRowCount; $rowIndex++)
        
                <tr>
            
                    @foreach ($sections as $sectionKey => $sectionLabel)
                
                        @if (!empty($user_information[$sectionKey]))
                    
                            @php
                        
                                $data = unserialize($user_information[$sectionKey]);
                            
                                $value = isset($data[$rowIndex]) ? $data[$rowIndex] : null;
                            
                            @endphp
                        
                            <td>
                        
                                @if($sectionKey == 'equivalent')
                            
                                    <input type="text" class="form-control form-control-sm" 
                                    
                                    placeholder="{{ $sectionLabel }}" 
                                
                                    name="{{ $sectionKey }}[]"
                                
                                    required value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">
                                
                                @elseif($sectionKey == 'position_additional_position_on_current_job')
                            
                                    <input type="text" class="form-control form-control-sm" 
                                    
                                    placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                     
                                    required value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">
                                
                                @elseif($sectionKey == 'economy_additional_position_on_current_job')
                           
                                    <input type="text" class="form-control form-control-sm" 
                                    
                                    placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                     
                                    required value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">
                            
                                @elseif ($sectionKey == 'document')
                        
                                    <input type="file" class="form-control form-control-sm" 
                                    
                                    placeholder="{{ $sectionLabel }}" name="{{ $sectionKey }}[]"
                                     
                                    >

                                    <input type="text" class="form-control form-control-sm" 
                                    
                                    placeholder="{{ $sectionLabel }}" name="oldDucument[]"
                                     
                                    value="{{ $value ?? old($sectionKey.'.'.$rowIndex) }}">

                                   


                                   <!-- <center> <a href="{{ asset('documents/' .$sectionKey.'.'.$rowIndex) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> -->
                            
                                @endif
                                

                            </td>
                        
                        @else
                    
                            <td></td> <!-- Empty cell if the section is empty -->
                        
                        @endif
                    
                    @endforeach
                
                </tr>
            
            @endfor
        
        </tbody>

    </table>

</div>