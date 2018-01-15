<div class="modal fade bs-statistic" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    		<h3>Статистика скачивания файла</h3>    		
    	</div>      
    	<div id="content-statistic" style="padding:20px;"></div>
    	<div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>	       
	      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">

	function loadStatistic(id)		
	{		
		$('#content-statistic').html('Загрузка...');
		
		$url = '<?= Route::createUrl('document/statistic', ['id'=>'{id}']) ?>';
		$url = $url.replace('{id}', id);

		$.get($url, function(data) {
			$('#content-statistic').html(data);
		})
		.fail(function() {
			$('#content-statistic').html('Произошла ошибка');
		});
	}

</script>