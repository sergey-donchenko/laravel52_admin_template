var system = require('../_System.js').getInstance();

module.exports = {
    stateSave: false,
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id'},
        {data: 'title'},
        {data: 'created'},
        {data: 'updated'},
        {data: 'published'},
    ],

        columns: [
        {data: 'id'},
        {data: 'title'},
        {data: 'date'},
        {data: 'employer'},
        {data: 'city'}
    ],

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
            /**
             * Render date
             **/
            render: function( data ) {
                return system.getFormattedDate( data );
            },
            targets: 2
        },{
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/vacancies/'+ row.id + '/edit" title="' + noTags + '">' +
                    system.ellipsis( noTags, 100 ) +
                    '</a>';
            },
            targets: 1
        }
    ],

    ajax: {
        url: system.getUrl( 'vacancies' )
    },


};