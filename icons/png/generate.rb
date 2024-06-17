require 'FileUtils'
require 'open3'


def createpng(srcfilename, destpath, basename)
    [32, 48, 64, 128, 256].each do |scale|
  

        cmd = "rsvg-convert #{srcfilename} -z #{scale/256.0} > #{basename}_#{scale}.png"
        puts cmd
        stdout, stderr, status = Open3.capture3(cmd)
        if !status.success?
            puts cmd
            abort "error: could not execute command: #{stderr}"
        end
    end
end


Dir.glob("../*.svg").select do |filename| 
    destpath = "./"
    basename = File.basename(filename, ".svg")
    
    createpng(filename, destpath, basename)
end
