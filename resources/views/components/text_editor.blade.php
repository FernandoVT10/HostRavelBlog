<div class="text-editor-container" id="textEditor">
    <div class="actions">
        <button type="button" class="action-button" data-action="image">
            <i class="fas fa-image"></i>
        </button>

        <button type="button" class="action-button" data-action="bold">
            <i class="fas fa-bold"></i>
        </button>

        <button type="button" class="action-button" data-action="italic">
            <i class="fas fa-italic"></i>
        </button>

        <button type="button" class="action-button" data-action="underline">
            <i class="fas fa-underline"></i>
        </button>

        <button type="button" class="action-button" data-action="strikeThrough">
            <i class="fas fa-strikethrough"></i>
        </button>

        <button type="button" class="action-button" data-action="link">
            <i class="fas fa-link"></i>
        </button>

        <button type="button" class="action-button" data-action="code">
            <i class="fas fa-code"></i>
        </button>
    </div>

    <input type="hidden" name="content" id="text_editor_input" value="{{$content}}" />
    <div
    class="editor-content article-content"
    id="text_editor_content" 
    contenteditable="true"
    spellcheck="false">
        {!! $content !!}
    </div>

    <div class="lds-ellipsis" id="image-loader"><div></div><div></div><div></div><div></div></div>
</div>

<div
class="modal fade"
id="linkModal"
tabindex="-1"
role="dialog"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Link Editor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="text_editor_title_link">
                        {{ __('Title') }}
                    </label>

                    <input
                    id="text_editor_title_link"
                    type="text"
                    class="form-control"
                    autocomplete="off"/>
                </div>

                <div class="form-group">
                    <label for="text_editor_href_link">
                        Href
                    </label>

                    <input
                    id="text_editor_href_link"
                    type="text"
                    class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button
                type="button"
                class="btn btn-primary"
                id="text_editor_add_link"
                data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>