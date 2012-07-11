# repository info
set :branch, "master"

# This may be the same as your `Web` server
role :app, "ccistudios.com"

# directories
set :deploy_to, "/home/wpg/subdomains/live"
set :public, "#{deploy_to}/public_html"
set :extensions, %w[com_cci public template com_slideshow com_calendar]
