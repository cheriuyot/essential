<div class="ui grid">
  <div class="three wide column">
    <div class="ui vertical menu">
      <div class="item">
        <div class="ui input"><input type="text" placeholder="Search..."></div>
      </div>
      <div class="item">
        <i class="octicon octicon-list-unordered"></i> Fields
        <div class="menu" id="field_list">
          <a class="active item" id="indicators"><i class="ion-toggle"></i>Indicators</a>
          <a class="item" id="questions"><i class="ion-help-circled"></i>Questions</a>
          <a class="item" id="resources"><i class="ion-hammer"></i>Resources</a>
          <a class="item" id="supplies"><i class="ion-ios7-box"></i>Supplies</a>
          <a class="item" id="equipment"><i class="ion-ios7-box"></i>Equipment</a>
          <a class="item" id="hcw"><i class="ion-ios7-people"></i>Health Care Workers</a>
        </div>
      </div>
      <a class="item">
        <i class="ion-gear-a"></i> Admin
      </a>
      <div class="ui dropdown item">
        More <i class="dropdown icon"></i>
        <div class="menu">
          <a class="item"><i class="edit icon"></i> Edit Profile</a>
          <a class="item"><i class="globe icon"></i> Choose Language</a>
          <a class="item"><i class="settings icon"></i> Account Settings</a>
        </div>
      </div>
      <a class="item">
        <i class="grid layout icon"></i> Browse
      </a>

    </div>
  </div>
  <div class="right floated twelve wide column" >

    <div class="ui segment stacked"  style="min-height:60%">
      <h5 id="title"></h5>
      <div id="display">

      </div>
    </div>
  </div>
</div>
<script>
$('#field_list a').click(function(){
  $('#field_list a').removeClass('active blue');
  $(this).addClass('active blue');
  title = $(this).text();
  object = $(this).attr('id');
  $('#title').text(title);
  $.ajax({
    url:base_url+'admin/get/'+object+'/table',
    beforeSend: function(xhr) {
      $('#display').empty();
      $('#display').append('<div class="loader" >Loading...</div>');
    },
    success: function(data) {
      obj = jQuery.parseJSON(data);
      $('#display').empty();
      // console.log(obj);
      table = '<table style="font-size:10px !important">';
      tr='';
      th='';
      thead='';
      counter=0;
      $.each(obj, function(k, v) {
        if(counter==0){
          thead+='<thead>';
          th='';
          $.each(v, function(key, value) {
            th+='<th>'+key+'</th>';
          });
          thead+=th+'</thead>';
        }
        if(counter<10){
          tr+='<tr>';
          td='';
          $.each(v, function(key, value) {
            td+='<td>'+value+'</td>';
          });
          tr+=td+'</tr>';
          counter++;
        }
      });
      table+=thead+tr+'</table>';
      // console.log(table);
      $('#display').append(table);
      // $(document).trigger('datatable_loaded');
    }
  });
});
</script>
