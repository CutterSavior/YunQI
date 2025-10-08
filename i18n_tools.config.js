/*
 * @Author: CutterSavior Nanaa.888080@Gmail.com
 * @Date: 2025-10-08 09:38:05
 * @LastEditors: CutterSavior Nanaa.888080@Gmail.com
 * @LastEditTime: 2025-10-08 09:39:23
 * @FilePath: \YunQI\i18n_tools.config.js
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

module.exports = {
      entry: ['src'], // 提取、还原、遗漏扫描入口文件夹，可以配置多个,默认是 src
      outDir: 'src/locales', // i18n 输出文件夹 默认是 src/locales
      outShow:1, //输出文件展示结构 1 扁平化结构 2树级结构 默认扁平化
      exclude: ['src/locales'], // 不提取的文件夹, 默认是 ['src/locales']
      extensions: ['.vue', '.js', '.ts','.php'], // 提取的文件后缀名，默认是 ['.js', '.vue', '.ts']
      filename: 'zh_tw', // 输出的文件名,默认为 zh_cn
      extname: 'js', //  输出的文件后缀名默认为 js  ,支持json和js（js格式为 module.exports = {} 或 export default {}），
      langList: ['en'] // 翻译目标语言列表，默认是 ['en']   具体语种请自行查看。注意：使用不同的翻译接口，需要更换对应的语言编码，腾讯翻译、火山翻译、谷歌翻译语言编码大致相同，百度要特别注意，与上述3种翻译有不同的语言编码
}