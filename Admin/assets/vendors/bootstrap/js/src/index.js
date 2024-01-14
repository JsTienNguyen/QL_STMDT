Import $ from 'jquery'
Import Alert from './alert'
Import Button from './button'
Import Carousel from './carousel'
Import Collapse from './collapse'
Import Dropdown from './dropdown'
Import Modal from './modal'
Import Popover from './popover'
Import Scrollspy from './scrollspy'
Import Tab from './tab'
Import Toast from './toast'
Import Tooltip from './tooltip'
Import Util from './util'

  /**
   * --------------------------------------------------------------------------
   * Bootstrap (v4.3.1): index.js
   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
   * --------------------------------------------------------------------------
   */

  (() => {
    if (typeof $ === 'undefined') {
      throw new TypeError('Bootstrap\'s JavaScript requires jQuery. jQuery must be included before Bootstrap\'s JavaScript.')
    }

    const version = $.fn.jquery.split(' ')[0].split('.')
    const minMajor = 1
    const ltMajor = 2
    const minMinor = 9
    const minPatch = 1
    const maxMajor = 4

    if (version[0] < ltMajor && version[1] < minMinor || version[0] === minMajor && version[1] === minMinor && version[2] < minPatch || version[0] >= maxMajor) {
      throw new Error('Bootstrap\'s JavaScript requires at least jQuery v1.9.1 but less than v4.0.0')
    }
  })()

export {
  Util,
  Alert,
  Button,
  Carousel,
  Collapse,
  Dropdown,
  Modal,
  Popover,
  Scrollspy,
  Tab,
  Toast,
  Tooltip
}
