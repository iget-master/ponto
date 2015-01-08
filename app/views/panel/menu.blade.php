<ul id="menu">
    <li><a href="/"><i class="fa fa-home"></i><span>Início</span></a></li>
    @if (Auth::user()->level >= 2)
		<li><a href="/user"><i class="fa fa-users"></i><span>Usuários</span></a></li>
	@endif
</ul>