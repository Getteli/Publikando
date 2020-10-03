$(document).ready(function(){
	// tooltip
	$('.tooltipped').tooltip();

	$('#contato').mask('(00) 0 0000-0000');

	// modal
	const ElemensModal = document.querySelectorAll(".modal");
	const InstanceModal = M.Modal.init(ElemensModal);

	// textarea form contato
	$('#textarea').val('');
	M.textareaAutoResize($('#textarea'));

	// toast
	const ElemensToast = document.querySelector("#toast");
	const InstanceToast = (msg) =>{
		M.toast({
			html: msg,
			classes: "rounded toastMobile"
		})
	}

	// validade email
	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

	// inicia a mensagem assim que o site carregar
	InstanceToast("Conheça nossos serviços em poucos cliques !");

	// function enviar msg
	$(".sendContato").on('click', function(e){

		// nome
		if($(this)[0].form.elements[0].value == null
			|| $(this)[0].form.elements[0].value == ""){
			$(this)[0].form.elements[0].focus();
			$(".p_warning").eq(0).show();
			return false;
		}
		// email
		if($(this)[0].form.elements[1].value == null
			|| $(this)[0].form.elements[1].value == ""
			|| !isEmail($(this)[0].form.elements[1].value)){
			$(this)[0].form.elements[1].focus();
			$(".p_warning").eq(1).show();
			return false;
		}
		// mensagem
		if($(this)[0].form.elements[3].value == null
			|| $(this)[0].form.elements[3].value == ""){
			$(this)[0].form.elements[3].focus();
			$(".p_warning").eq(2).show();
			return false;
		}

		if(!$(".p_warning").eq(0).is(':empty')){
			$(".p_warning").eq(0).hide();
		}
		
		if(!$(".p_warning").eq(1).is(':empty')){
			$(".p_warning").eq(1).hide();
		}
		
		if(!$(".p_warning").eq(2).is(':empty')){
			$(".p_warning").eq(2).hide();
		}	

		$(".sendContato").addClass("disabled");
		$(".lbl_form").show();
		$(".lbl_form_padrao").hide();

		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(".form_contact").serialize();
		var url = "_assets/scripts/send-mail.min.php";
		$.ajax({
			type: "POST",
			url: url,
			data: form, // serializes the form's elements.
			success: function (data) {
				InstanceToast("mensagem enviada com sucesso !");
			},
			error: function (data) {
				InstanceToast("erro ao enviar mensagem, verifique e tente novamente.");
			},
			complete: function () {
				$(".sendContato").removeClass("disabled");
				$(".lbl_form").hide();
				$(".lbl_form_padrao").show();
			},
		});
	});

	// function enviar msg mobile
	$(".sendContatoMob").on('click', function(e){

		// nome
		if($(this)[0].form.elements[0].value == null
			|| $(this)[0].form.elements[0].value == ""){
			$(this)[0].form.elements[0].focus();
			$(".p_warning").eq(0).show();
			return false;
		}
		// email
		if($(this)[0].form.elements[1].value == null
			|| $(this)[0].form.elements[1].value == ""
			|| !isEmail($(this)[0].form.elements[1].value)){
			$(this)[0].form.elements[1].focus();
			$(".p_warning").eq(1).show();
			return false;
		}
		// mensagem
		if($(this)[0].form.elements[3].value == null
			|| $(this)[0].form.elements[3].value == ""){
			$(this)[0].form.elements[3].focus();
			$(".p_warning").eq(2).show();
			return false;
		}

		if(!$(".p_warning").eq(0).is(':empty')){
			$(".p_warning").eq(0).hide();
		}
		
		if(!$(".p_warning").eq(1).is(':empty')){
			$(".p_warning").eq(1).hide();
		}
		
		if(!$(".p_warning").eq(2).is(':empty')){
			$(".p_warning").eq(2).hide();
		}	

		$(".sendContatoMob").addClass("disabled");
		$(".lbl_form").show();
		$(".lbl_form_padrao").hide();

		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(".form_contactMob").serialize();
		var url = "_assets/scripts/send-mail.min.php";
		$.ajax({
			type: "POST",
			url: url,
			data: form, // serializes the form's elements.
			success: function (data) {
				InstanceToast("mensagem enviada com sucesso !");
			},
			error: function (data) {
				InstanceToast("erro ao enviar mensagem, verifique e tente novamente.");
			},
			complete: function () {
				$(".sendContatoMob").removeClass("disabled");
				$(".lbl_form").hide();
				$(".lbl_form_padrao").show();
			},
		});
	});
});