
<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageLabel">Mensagem ao Chat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/send-message" method="POST">
        @csrf
        <div class="sandbox-message">
          <div class="message">
            <input type="text" name="message" class="form-control" placeholder="Mensagem">
            <input type="hidden" name="chat_id" class="form-control message-chat-sender" value="" placeholder="Mensagem">
          </div>
          <div class="btn-submit">
            <button type="submit" class="btn btn-primary has-ripple">
              Enviar
              <span class="ripple ripple-animate" style="height: 86.375px; width: 86.375px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -16.3594px; left: -26.1875px;">
              </span>
            </button>
          </div>
        </div>
      </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

