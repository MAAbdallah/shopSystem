<!doctype html>
<html>
<body>
<input type='text' id='search' name='search' placeholder='Enter companyid 1-27'><input type='button' value='Search' id='but_search'>
<br/>
<input type='button' value='Fetch all records' id='but_fetchall'>

<table border='1' id='companyTable' style='border-collapse: collapse;'>
    <thead>
    <tr>
        <th>S.no</th>
        <th>Company name</th>
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

        // Search by companyid
        $('#but_search').click(function(){
            var companyid = Number($('#search').val().trim());

            if(companyid > 0){
                fetchRecords(companyid);
            }

        });

    });

    function fetchRecords(id){
        $.ajax({
            url: '/getCompanies/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;
                $('#companyTable tbody').empty(); // Empty <tbody>
                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i=0; i<len; i++){
                        var id = response['data'][i].id;
                        var companyname = response['data'][i].name;

                        var tr_str = "<tr>" +
                            "<td align='center'>" + (i+1) + "</td>" +
                            "<td align='center'>" + companyname + "</td>" +
                            "</tr>";

                        $("#companyTable tbody").append(tr_str);
                    }
                }else if(response['data'] != null){
                    var tr_str = "<tr>" +
                        "<td align='center'>1</td>" +
                        "<td align='center'>" + response['data'].name + "</td>" +
                        "</tr>";

                    $("#companyTable tbody").append(tr_str);
                }else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4'>No record found.</td>" +
                        "</tr>";

                    $("#companyTable tbody").append(tr_str);
                }

            }
        });
    }
</script>
</body>
</html>
