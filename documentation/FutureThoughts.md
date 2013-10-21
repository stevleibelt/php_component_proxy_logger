# Future Thoughts

* think about using a numbers internal instead of log level arrays for validating if current log level is below or in (in the hierarchy point of view) the trigger
* add description about benefits of using *UpwardFlushBufferTrigger*
* add constants or well named setter methods for LogRequestFactoryInterface::setLogRequestClassName
* style output - if level is reached, wrap the buffer output with something like "==== log level buffer flush triggered ====" or "==== log level buffer bypassed ===="
* implement locking
* implement "unsetFlushBufferTrigger" to AwareInterface
* implement "unsetBypassBuffer" to AwareInterface
* validate if [monolog](https://github.com/Seldaek/monolog) is not doing the same thing
* submit idea to [log4php](https://logging.apache.org/log4php/)
    * [Contributing](http://wiki.apache.org/logging-log4php/Contributing)
    * [Installing](http://logging.apache.org/log4php/install.html)
    * [Volunteering](https://logging.apache.org/log4php/volunteering.html)
    * [How ASF works](http://www.apache.org/foundation/how-it-works.html)
    * [Subscribe Mailinglists](http://www.apache.org/foundation/mailinglists.html)
    * [Mailinglists](http://logging.apache.org/log4php/mail-lists.html)

