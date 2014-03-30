{{ HTML::style('dist/css/selectize.bootstrap3.css')}
<script type="text/javascript" src="../script/selectize.js"></script>
<select id="transactionsearchbox" name="transactionq"  class="form-control"></select>
 
<script> 
    $(document).ready(function(){
    $('#transactionsearchbox').selectize({
        valueField: 'url',
        labelField: 'name',
        searchField: ['name'],
        maxOptions: 10,
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' + escape(item.name) + '</div>';
            }
        },
        optgroups: [
            {value: 'item', label: 'Items'},
            {value: 'itemcategory', label: 'Item Categories'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['item','itemcategory'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: siteloc + '/api/search',
                type: 'GET',
                dataType: 'json',
                data: {
                    transactionq: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            window.location = this.items[0];
        }
    });
});
</script>
