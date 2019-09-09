<script>
  $(function()
    {
      //auto refresh for 5 minutes
      setInterval(function(){ updateTable(); }, 300000);
      
      $("#table-javascript").bootstrapTable(
      {
        method: 'get',
        url: '<?=base_url()?>/ajax/data_alarm.php',
        cache: false,
        striped: true,
        pagination: true,
        pageSize: 10,
        pageList: [10, 25, 50, 100],
        search: true,
        showColumns: true,
        showRefresh: true,
        showToggle: true,
        smartDisplay: true,
        minimumCountColumns: 2,
        clickToSelect: true,
        sortName: "id",
        sortOrder: 'asc',
      });
      
      function updateTable()
      {
        $('#table-javascript').bootstrapTable('refresh');
      }
      
   });
  
 window.operateEvents =
    {
        'click .like': function (e, value, row) {
            alert('You click like action, row: ' + JSON.stringify(row));
        },
        'click .remove': function (e, value, row) {
            alert('You click remove action, row: ' + JSON.stringify(row));
        }
    };
    
    function operateFormatter(value, row, index)
    {
        return [
            '<div class="pull-left">',
              '<a href="main.php?page_id=dashboard_alarm&id='+ row.site_id + '&area='+row.alamat+'">' + value + '</a>',
            '</div>'
        ].join('');
    }

    function rowStyle(row, index)
    {
      var classes = ['active', 'success', 'info', 'warning', 'danger'];
      console.log(row);
      if(parseInt(row.alarm_value) ===0)
      {
          return {classes : "active" };
      }
      else
      {
        return {classes : "danger" };
      }
      return {};
  }
  
  function cellStyle(value, row, index, field)
  {
     var classes = ['text-success', 'text-danger'];
      console.log(row);
      if(parseInt(row.alarm_value) ===0)
      {
          return {classes : "text-success" };
      }
      else
      {
        return {classes : "text-danger" };
      }
      return {};
}
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success" role="alert">
                <p class="text-center">
                    Alarm Information
                </p>
            </div>        
        </div>
    </div>
    
    <div class="row">
    <div class="col-lg-s12">
        <table id="table-javascript">
            <thead>
                <tr id="row-table-javascript">
                  <th data-field="site_id"data-sortable="true"
                  data-formatter="operateFormatter"
                  data-events="operateEvents">Site ID</th>
                  <th data-field="alamat" data-sortable="true">Alamat</th>
                  <th data-field="waktu" data-sortable="true">Waktu</th>
                  <th data-field="object_alarm" data-sortable="true">Objek Alarm</th>
                  <th data-field="nilai_alarm" data-sortable="true" data-cell-style="cellStyle">Nilai Alarm</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>