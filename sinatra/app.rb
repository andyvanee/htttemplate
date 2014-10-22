require 'sinatra'
require 'mustache'
require 'net/http'
require 'uri'

def get_layout(path)
  @layouts ||= {}
  @layouts[path.to_sym] ||= Net::HTTP.get(URI.parse(path))
end

get '/' do
  @layout = get_layout 'https://andyvanee.github.io/htttemplate/basic/layout.html'
  Mustache.render(@layout, {
    :site_title => 'My Sinatra Site',
    :title => 'Home',
    :main => '<p>Welcome to my Sinatra site using htttemplates!!</p>'
  })
end
