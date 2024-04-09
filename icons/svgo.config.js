const { extendDefaultPlugins } = require('/Users/fabiosoldati/.config/yarn/global/node_modules/svgo/lib/svgo-node.js');
module.exports = {
  multipass: true, // boolean. false by default
  plugins: extendDefaultPlugins([
  	{
      name: 'removeUselessStrokeAndFill',
      active: false
    },
  	{
      name: 'removeAttrs',
      params: {
       attrs: '*:(fill|stroke):((?!none).)*', // remove fill and stroke unless 'none'
      }
    },
    {
      name: 'removeXMLNS',
    }
  ])
}