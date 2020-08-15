@component('mail::message')
#  <span style="text-transform: uppercase;font-weight: 600;font-size: 40px;">{{ Helper::username($qparty->user_id) }}'s <span style="color: #ff8a00;font-weight: 800;">{{ Helper::media_name($media_house_id) }}</span> has invited you for a <span style="color: #ff8a00;font-weight: 800;">Q Party</span></span>
<small style="color: #f00;font-weight: bold;align-items: center;">(A place where people will be invited to ask questions to you.)</small>
<center><h1>{{ $qparty->title }}</h1></center>
	
{{ $qparty->description }}

@component('mail::button', ['url' => $url])
Accept the Invitation
@endcomponent

@endcomponent
