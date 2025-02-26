$(function(){
    $(document).on('click', '.delete-row', function(){
        $(this).parents('.gametime-row').remove();
    });
    $('.add-row').on('click', function(){

        let row = `<div class="row text-center gametime-row">
                    <div class="span3">
                        <input type="datetime-local" class="form-control" name="gametime[]" />
                    </div>
                    <div class="span3">
                        <select class="form-control" name="gate[]">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="span3">
                        <select class="form-control" name="field[]">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="span3">
                        <input type="button" value="X" class="btn btn-danger delete-row" />
                    </div>
                </div>`;

        $('#gametimes').append(row);
    });
});
