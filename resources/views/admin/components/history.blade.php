<a onclick="event.preventDefault(); document.getElementById('audits-form').submit();"
href="{{ route('admin.audits.show', $auditable_id) }}"
class="btn btn-xs btn-default">Histórico <i class="fa fa-history" aria-hidden="true"></i></a>

<form id="audits-form"
action="{{ route('admin.audits.show', $auditable_id) }}" method="POST"
style="display: none;">
@csrf

<input type="text" class="form-control" name="auditable_id" id="auditable_id" value="{{ $auditable_id }}" placeholder="">
<input type="text" class="form-control" name="auditable_type" id="auditable_type" value="{{ $auditable_type }}" placeholder="">
</form>
