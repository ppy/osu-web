<?php $current_section = $current_action = "oauth"; ?>
@extends("master")
@section("content")
<div class="osu-layout__row osu-layout__row--page osu-layout__row--bootstrap">
  <h2>Granting access to: <pre>{{$client->getName()}}</pre></h2>
  <form method="post" action="{{route('oauth.authorize.post', $params)}}">
    {{ csrf_field() }}
    <input type="hidden" name="client_id" value="{{$params['client_id']}}">
    <input type="hidden" name="redirect_uri" value="{{$params['redirect_uri']}}">
    <input type="hidden" name="response_type" value="{{$params['response_type']}}">
    <input type="hidden" name="state" value="{{$params['state']}}">
    <input type="hidden" name="scope" value="{{$params['scope']}}">

    <input type="submit" name="approve" value="approve">
    <input type="submit" name="deny" value="deny">
  </form>
</div>
@stop
