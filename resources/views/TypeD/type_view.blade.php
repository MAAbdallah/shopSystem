<!doctype html>
<html>
<body>
<input type='text' id='search' name='search' placeholder='Enter typeid 1-27'><input type='button' value='Search' id='but_search'>
<br/>
<input type='button' value='Fetch all records' id='but_fetchall'>

<table border='1' id='typeTable' style='border-collapse: collapse;'>
    <thead>
    <tr>
        <th>S.no</th>
        <th>type name</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Script -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --> <!-- jQuery CDN -->
<script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>

<script type='text/javascript'>
    $(document).ready(function(){

        // Fetch all records
        $('#but_fetchall').click(function(){
            fetchRecords(0);
        });

        // Search by typeid
        $('#but_search').click(function(){
            var typeid = Number($('#search').val().trim());

            if(typeid > 0){
                fetchRecords(typeid);
            }

        });

    });

    function fetchRecords(id){
        $.ajax({
            url: '/getTypes/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;
                $('#typeTable tbody').empty(); // Empty <tbody>
                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i=0; i<len; i++){
                        var id = response['data'][i].id;
                        var typename = response['data'][i].name;

                        var tr_str = "<tr>" +
                            "<td align='center'>" + (i+1) + "</td>" +
                            "<td align='center'>" + typename + "</td>" +
                            "</tr>";

                        $("#typeTable tbody").append(tr_str);
                    }
                }else if(response['data'] != null){
                    var tr_str = "<tr>" +
                        "<td align='center'>1</td>" +
                        "<td align='center'>" + response['data'].name + "</td>" +
                        "</tr>";

                    $("#typeTable tbody").append(tr_str);
                }else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4'>No record found.</td>" +
                        "</tr>";

                    $("#typeTable tbody").append(tr_str);
                }

            }
        });
    }
</script>
</body>
</html>
