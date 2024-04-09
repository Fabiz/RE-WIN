require 'FileUtils'
require 'open3'

$webpath = "/Users/fabiosoldati/Repository/Github/PeakFinder-Nuxt/icons/"


puts "generate web icons"


def generatevue(filename, outfilename = nil)

  outfilename = filename if outfilename == nil
  srcfilename = "./icons/#{filename}.svg"
  destfilename = "#{$webpath}pf#{outfilename.tr('_', '')}.vue"
  
  puts "generate #{srcfilename} #{destfilename}"
    
  svgocmd = "svgo --config svgo.config.js #{srcfilename} --output -"
  #puts svgocmd
    
  stdout_str, error_str, status = Open3.capture3(svgocmd)
  if status.success?
    # okay
  else
    raise "did not work"
  end


  File.open(destfilename, "w") do |f|
    f.puts "<template>"
    f.puts stdout_str
    f.puts "</template>"

    f.puts "<script>"
    f.puts "export default {"
    f.puts "  name: 'pf#{outfilename.tr('_', '')}'"
    f.puts "}"
    f.puts "</script>"
  end
end

#generatevue('coordinates')
generatevue('account')
generatevue('account_edit')
generatevue('android')
generatevue('app')
generatevue('apple')
generatevue('arrow_down')
generatevue('back')
generatevue('bird')
generatevue('bulleye')
generatevue('camera')
generatevue('cancel')
generatevue('color')
generatevue('color_sel')
generatevue('down_small')
generatevue('down')
generatevue('email')
generatevue('export3', 'export')
generatevue('exclamation', 'error')
generatevue('facebook')
generatevue('google')
generatevue('gps')
generatevue('grid')
generatevue('hint_cameraadjustment', 'camera_adjustment')
generatevue('hint_compass_activate', 'compass_activate')
generatevue('hint_compass_deactivate', 'compass_deactivate')
generatevue('hint_compasscalibration', 'compass_calibration')
generatevue('hint_compasscorrection', 'compass_correction')
generatevue('hint_elevationoffset', 'elevationoffset')
generatevue('hint_photoeditor', 'photoeditor')
generatevue('hint_photos', 'photos')
generatevue('hint_privacy', 'privacy')
generatevue('hint_telescope', 'telescope')
generatevue('show_me')
generatevue('info')
generatevue('link')
generatevue('next')
generatevue('map')
generatevue('mapwithmarker')
generatevue('flag_outlined', 'mark')
generatevue('mark_bookmark')
generatevue('mark_favorite')
generatevue('mark_home')
generatevue('mark_star')
generatevue('menu')
generatevue('minus')
generatevue('mountain')
generatevue('move', 'coordinates')
generatevue('play')
generatevue('plus')
generatevue('prev')
generatevue('projection_cylindrical')
generatevue('projection_perspective')
generatevue('question')
generatevue('refresh')
generatevue('satellite')
generatevue('save', 'download')
generatevue('search')
generatevue('settings_coords_decimal', 'coords_decimal')
generatevue('settings_coords_degree', 'coords_degree')
generatevue('settings_metric_feet', 'unit_imperial')
generatevue('settings_metric_meter', 'unit_metric')
generatevue('settings_moon_show', 'moon')
generatevue('settings_sun_show', 'sun')
generatevue('settings')
generatevue('sliders')
generatevue('snapshot')
generatevue('star_full')
generatevue('star_half')
generatevue('star')
generatevue('twitter')
generatevue('viewpoint')
generatevue('www')

