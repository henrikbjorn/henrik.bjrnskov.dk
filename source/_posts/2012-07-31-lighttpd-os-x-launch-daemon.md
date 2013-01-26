---
layout: post
title: "Lighttpd LaunchDaemon for OS X 10.8 (Mountain Lion)"
---

This is just a quick post to help me save some gried when i need to do this another time.

    <?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
    <plist version="1.0">
      <dict>

        <key>Label</key>
        <string>homebrew.mxcl.lighttpd</string>

        <key>ProgramArguments</key>
        <array>
          <string>/usr/local/sbin/lighttpd</string>
          <string>-f</string>
          <string>/usr/local/etc/lighttpd/lighttpd.conf</string>
          <string>-D</string>
        </array>

        <key>Disabled</key>
        <false/>

        <key>KeepAlive</key>
        <true/>

        <key>UserName</key>
        <string>root</string>

        <key>GroupName</key>
        <string>staff</string>

        <key>RunAtLoad</key>
        <true/>

      </dict>
    </plist>
