<h2>Forgot your password?</h2>

{{-- <%= form_for(resource, as: resource_name, url: password_path(resource_name), html: { method: :post }) do |f| %>
  <%= devise_error_messages! %> --}}
    <form method="post">
        {{ csrf_field() }}
        <div class="field">
            <label>Email</label><br />
            <input type="email" name="email" autofocus="true">
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary btn2 col-md-3 col-md-offset-9">Send me reset password instructions</button>#
        </div>
    </form>
