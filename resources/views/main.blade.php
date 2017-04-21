<!DOCTYPE html>
<html lang="en">
  <head>
    @include("partials.head")
  </head>
  <body>
      @include("partials.nav")
      <div class="container">
        @include("partials.messages")
        @yield("content")
      </div>
      @include("partials.javascripts")
      @yield('scripts')
  </body>
</html>
