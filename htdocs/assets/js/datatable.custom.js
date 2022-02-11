$(document).ready(function() {

    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    let dt_table = $('#manage').DataTable({
                        processing: true,
                        serverSide: true,
                        lengthMenu: [5, 10, 15, 20, 25],
                        columnDefs: [
                            {
                                orderable: false,
                                targets: [3, 4, 5]
                            },
                        ],
                        language : {
                            processing: '<i class="fa fa-circle-notch fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
                        },
                        ajax: {
                            url: "/posts/ssd",
                            method: "POST",
                        },
                        columns: [
                            { 
                                data : "id",                    
                            },
                            { data : "title" },
                            { data : "content" },
                            { data : "created_at" },
                            { 
                                data : "is_published",
                                render : function (data, type, row) {
                                    if(row.is_published == 1) {
                                        return `<button data-id="${row.id}" class="post-publish-btn text-success"><i class="fas fa-minus-circle"></i><span> Unpublish</span></button>`;
                                    }else {
                                        return `<button data-id="${row.id}" class="post-publish-btn text-secondary"><i class="fas fa-minus-circle"></i><span> publish</span></button>`;
                                    }
                                }
                            },
                            {
                                data : "",
                                render : function (data, type, row) {
                                    return `
                                    <div class="d-flex">
                                        <a href="/posts/edit/${row.id}" class="post-edit-btn"><i class="fas fa-edit p-2 text-warning"></i></a>
                                        <button data-id="${row.id}" class="post-delete-btn"><i class="fas fa-trash p-2 text-danger"></i></button>
                                    </div>
                                    `;
                                }
                            },
                    ]
                    });

    $(document).on('click', '.post-publish-btn', function(e) {
        let id = $(this).data('id');

        let route_para = $('#publish_post_form').attr('action').replace('@id', id);
        let route = $('#publish_post_form').attr('action', route_para);

        $('#publish_post_form').submit();
    });

    $(document).on('click', '.post-delete-btn', function(e) {
        let id = $(this).data('id');

        let route_para = $('#delete_post_form').attr('action').replace('@id', id);
        let route = $('#delete_post_form').attr('action', route_para);
        
        $('#delete_post_form').submit();
    });
} );