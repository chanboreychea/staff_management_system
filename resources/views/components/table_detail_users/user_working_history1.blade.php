<h6 class="form-top-header">៣.ប្រវត្តិការងារ</h6>
    
    <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ក.ក្នុងវិស័យមុខងារសាធារណៈ</h6>
    
    <div class="table-responsive">
    
    <table class="table table-bordered" >

        <thead>

            <th class="nowrap text-size" colspan="2">ថ្ងៃខែឆ្នាំបំពេញការងារ</th>
            
            <th class="nowrap text-size" rowspan="2">ក្រសួង/ស្ថាប័ន</th>
            
            <th class="nowrap text-size" rowspan="2">អង្គភាព</th>
            
            <th class="nowrap text-size" rowspan="2">មុខតំណែង</th>
            
            <th class="nowrap text-size"  rowspan="2">ផ្សេងៗ</th>

        <thead>
        
        <tbody>
        
            <tr>
                
                <td class="text-size text-center">ចូល</td>
                
                <td class="text-size text-center">បញ្ខប់</td>

                <td class="text-size text-center" colspan="4"></td>
            
            </tr>
            
            @if(isset($userWoringHistoryPublicSetor))
            
                @foreach($userWoringHistoryPublicSetor as $row )
            
                <tr>
                    
                    <td  class="nowrap text-size">{{$row->start_date}}</td>
                    
                    <td  class="nowrap text-size">{{$row->end_date}}</td>
                    
                    <td  class="text-size">{{$row->ministry}}</td>
                    
                    <td  class="text-size">{{$row->economy}}</td>
                    
                    <td  class="text-size">{{$row->position}}</td>
                    
                    <td  class="text-size">{{$row->other}}</td>
                
                </tr>  
                
                @endforeach
            
            @endif
        
        <tbody>
        
    </table>  

</div>
<!-- -------------------------------------------------------------------------------- -->
<h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ.ក្នុងវិស័យឯកជន</h6>
    
    <div class="table-responsive">
    
    <table class="table table-bordered" >

        <thead>

            <th class="nowrap text-size" colspan="2">ថ្ងៃខែឆ្នាំបំពេញការងារ</th>
            
            <th class="nowrap text-size" rowspan="2">គ្រឺះស្ថាន/អង្គភាព</th>
            
            <th class="nowrap text-size" rowspan="2">មុខតំណែង</th>
            
            <th class="nowrap text-size" rowspan="2">ជំនាញ/បច្ចេកទេស</th>
            
            <th class="nowrap text-size"  rowspan="2">ផ្សេងៗ</th>

        <thead>
        
        <tbody>
        
            <tr>
                
                <td class="text-size text-center">ចូល</td>
                
                <td class="text-size text-center">បញ្ខប់</td>

                <td class="text-size text-center" colspan="4"></td>
            
            </tr>
            
            @if(isset($userWoringHistoryPrivateSetor))
            
                @foreach($userWoringHistoryPrivateSetor as $row )
            
                <tr>
                    
                    <td  class="nowrap text-size">{{$row->start_date}}</td>
                    
                    <td  class="nowrap text-size">{{$row->end_date}}</td>
                    
                    <td  class="text-size">{{$row->economy}}</td>
                     
                    <td  class="text-size">{{$row->position}}</td>

                    <td  class="text-size">{{$row->tecnology}}</td>
                    
                    <td  class="text-size">{{$row->other}}</td>
                
                </tr>  
                
                @endforeach
            
            @endif
        
        <tbody>
        
    </table>  

</div>