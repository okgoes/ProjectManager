function createRows(isParam) 
{
    if (isParam) {
        return dialogParams();;
    }
    return dialogResults();
}

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
                $('.interface_params table tbody').append(html);
                clear();
                $('.next-level').prop('data-params-id', results.id);
                $('.next-level').unbind('click').bind('click', function() {
                    $("#dialogForParams").prop('data-params-id', $(this).prop('data-params-id'));
                    $("#dialogForParams").prop('data-type', 'params');
                    $("#dialogForParams").modal({show: true});
                    $("#dialogForParams").on('shown.bs.modal', function (e) {
                    })
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
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


