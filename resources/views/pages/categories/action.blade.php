
    <div class="d-flex text-right">
        <a href="{{ route('categories.edit', $id) }}" class=" btn btn-sm btn-icon btn-pure btn-default"
           data-toggle="tooltip" data-original-title="Edit" title="Edit" data-plugin="ladda" data-style="zoom-in">
            <span class="ladda-label"><i class="bx bx-edit pl-5" aria-hidden="true"></i></span>
        </a>
        <a href="javascript:void(0);"
           class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-delete"
           data-toggle="tooltip"
           data-original-title="Delete"
           title="Delete"
           data-url="{{ route('categories.destroy', $id) }}">
            <span class="ladda-label"><i class="bx bx-trash" aria-hidden="true"></i></span>
        </a>


    </div>

