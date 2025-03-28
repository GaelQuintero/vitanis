<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-theme="dark">
    <div id="modalSize" class="modal-dialog modal-dialog-centered modal-dialog-scrollable" data-bs-theme="dark">
        <div class="modal-content">
            <div class="my-0 py-0 modal-header" style="background: #20346A; padding: 0.5rem !important;">
                <h2 style="color:white; padding-left: 1rem !important; color: #DFE6EC; font-size: 1.2rem !important;"
                    class="modal-title w-100 d-flex justify-content-center justify-content-lg-start">
                    <span id="modalTitle"></span>
                </h2>
                <button type="action"
                    style="background-color: rgba(0, 0, 0, 0); border-radius: 8px; border: 0; font-size: 1.5rem; color: #DFE6EC; padding: 0.2rem 0.8rem;"
                    onclick="$('.modal').modal('hide');" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body container" id="modalBody">
            </div>
        </div>
    </div>
</div>
