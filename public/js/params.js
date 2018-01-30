function createRows(isParam) 
{
    if (isParam) {
        return dialogParams();;
    }
    return dialogResults();
}

/**
 * 创建参数
 */
function dialogParams() {
    $('.control-label-required').html('是否必填');
    $('#dialogForParams').modal({show: true});
    $('.confirm-next').unbind('click').bind('click', function() {
        var data = {
            fieldName: $("#dialogForParams input[name='fieldName']").val(),
            fieldType: $("#dialogForParams select[name='fieldType']").val(),
            required: $("#dialogForParams input[name='required']:checked").val(),
            comment: $("#dialogForParams input[name='comment']").val(),
            case: $("#dialogForParams input[name='case']").val()
        };
        if (!/\S/.test(data.fieldName)) {
            return alert('字段不能为空');
        }
        data.interfaceId = $('.interface_params').prop('data-interface_id');
        if (!/\S/.test(data.interfaceId)) {
            return alert('接口不存在');
        }
        
        var parentId = $("#dialogForParams").prop('data-params-id');
        var level = $("#dialogForParams").prop('data-params-level');
        var type = $("#dialogForParams").prop('data-type');
        if (type != 'params') {
            return alert('非参数增加');
        }
        data.parent_id = 0;
        if (parentId) {
            data.parent_id = parentId;
        }
        if (!level) {
            level = 1;
        }
        $.ajax({
            url: '/interface/createParams',
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(result) {
                var html = '<tr>';
                if (level > 1) {
                    html += '<td>|';
                } else {
                    html += '<td>';
                }
                for (var i = 0; i < level; i ++) {
                    html +=  + '-';
                }
                html += data.fieldName + '</td>';
                html += "<td> " + $("#dialogForParams select[name='fieldType'] option[value='" + data.fieldType + "']").html() + "</td>";
                html += "<td> " + (data.required == 1 ? "是" : "否") + "</td>";
                html += "<td> " + data.comment + "</td>";
                html += "<td>" + data.case + "</td>";
                html += "<td class='op'><a class='btn btn-default next-level'><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></a></td>";
                html += "</tr>";
                $('.interface_params table tbody').append(html);
                clear();
                createSonParams(result.id, level);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
}

/**
 * 创建子级参数
 */
function createSonParams(parentId, levels) 
{
    $('.next-level').prop('data-params-id', parentId);
    $('.next-level').prop('data-params-level', levels);
    $('.next-level').unbind('click').bind('click', function() {
        $("#dialogForParams").prop('data-params-id', $(this).prop('data-params-id'));
        $("#dialogForParams").prop('data-params-level', $(this).prop('data-params-level'));
        $("#dialogForParams").prop('data-type', 'params');
        $("#dialogForParams").modal({show: true});
    });
}

function clear() {
    $("#dialogForParams input[name='fieldName']").val('');
    $("#dialogForParams select[name='fieldType'] option").prop('selected', 'false');
    $("#dialogForParams select[name='fieldType'] option").first().prop('selected', 'selected');
    $("#dialogForParams input[name='required']:checked").attr('checked', 'false');
    $("#dialogForParams input[name='required']").first().prop('checked', 'checked');
    $("#dialogForParams input[name='comment']").val('');
    $("#dialogForParams input[name='case']").val('')
}

function dialogResults() {
    $('.control-label-required').html('一定存在');
    $('#dialogForParams').modal({show: true});
    $('.confirm-next').unbind('click').bind('click', function() {
        var data = {
            fieldName: $("#dialogForParams input[name='fieldName']").val(),
            fieldType: $("#dialogForParams select[name='fieldType']").val(),
            required: $("#dialogForParams input[name='required']:checked").val(),
            comment: $("#dialogForParams input[name='comment']").val(),
            case: $("#dialogForParams input[name='case']").val()
        };
        if (!/\S/.test(data.fieldName)) {
            return alert('字段不能为空');
        }
        $.ajax({
            url: '/interface/createParams',
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(results) {
                var html = '<tr>';
                html += '<td>' + data.fieldName + '</td>';
                html += "<td> " + $("#dialogForParams select[name='fieldType'] option[value='" + data.fieldType + "']").html() + "</td>";
                html += "<td> " + (data.required == 1 ? "是" : "否") + "</td>";
                html += "<td> " + data.comment + "</td>";
                html += "<td>" + data.case + "</td>";
                html += "<td class='op'><a class='btn btn-default next-level'><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></a></td>";
                html += "</tr>";
                $('.interface_results table tbody').append(html);
                clear();
                $('.next-level').prop('data-results-id', results.id);
                $('.next-level').unbind('click').bind('click', function() {
                    $("#dialogForParams").modal({show: true});
                    $("#dialogForParams").on('shown.bs.modal', function (e) {
                        $('.next-level').prop('data-results-id', results.id);
                        $("#dialogForParams").prop('data-type', 'results');
                    })
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
}

function getParamsAndResults(interfaceId) {
	$.ajax({
		url: '/interface/detail',
		data: {interfaceId: interfaceId},
		dataType: 'json',
		type: 'post',
		success: function(data) {
			
		},
		error: function(err) {
			
		}
	});
}

function updateInterface(interfaceId, name, url, requestMethod, description) {
	$.ajax({
		url: '/interface/update',
		data: {interfaceId: interfaceId, name: name, url: url, requestMethod:requestMethod, description: description },
		dataType: 'json',
		type: 'post',
		success: function(data) {
			
		},
		error: function(err) {
			
		}
	});
}

