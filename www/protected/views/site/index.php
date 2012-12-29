<div id="login-holder">
            <form method="POST" action="">
                <div class="select-values hidden">
                    <a href="#" id="1">Dog</a>
                    <a href="#" id="2">Cat</a>
                    <a href="#" id="3">Pig</a>
                    <a href="#" id="4">Chicken</a>
                    <a href="#" id="5" class="last">Bird</a>
                </div>
                <label>
                    <input type="text" class="text radius" name="nickname" value="Tiername" />
                </label>
                <label class="select-holder">
                    <span class="text radius unselectable" unselectable="on">Tierart wählen</span>
                    <input type="hidden" name="type-select" />
                    <a href="#" class="select-m"></a>
                </label>
                <label>
                    <input type="text" class="text radius email" name="email" value="E-Mail-Adresse" />
                </label>
                <label>
                    <span>Passwort</span>
                    <input type="password" class="text radius" name="pass1" value="" />
                </label>
                <label>
                    <span>Passwort wiederholen</span>
                    <input type="password" class="text radius" name="pass2" value="" />
                </label>

                <input type="submit" class="submit" value="Anmelden" />

                <p>Erstelle <?=CHtml::link('hier',array('members/signup'));?> eine Seite für Unternehmen, Shop,<br />
                    Verein oder Organisation
                </p>
            </form>
        </div>

        <div id="intro-holder">
            <div class="el el1"></div>
            <div class="el el2"></div>
            <div class="el el3"></div>
            <div class="el el4"></div>

            <a href="#" class="button button-rss"></a>
            <a href="#" class="button button-like"></a>

            <div class="navigator">
                <a href="#" class="active"></a>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>
        </div>

        <div class="clear"></div>
        <div class="index-bg">
            <p class="i">Bekannt aus den Medien:</p>

            <div class="sub-slider">
                <a href="#left" class="left"></a>

                <div id="lenta-holder">
                    <ul class="lenta">
                        <li class="l1"><a href="#"></a></li>
                        <li class="l2"><a href="#"></a></li>
                        <li class="l3"><a href="#"></a></li>
                        <li class="l4"><a href="#"></a></li>
                        <li class="l5"><a href="#"></a></li>
                        <li class="l6"><a href="#"></a></li>
                        <li class="l7"><a href="#"></a></li>
                    </ul>
                </div>

                <a href="#right" class="right r"></a>
            </div>

            <table width="100%">
                <tr>
                    <td class="l">
                        <h2>Was bei uns gerade passiert</h2>
                        <div class="top-border-dotted">
                            <img src="i/fish-1.png" />
                            <span class="b">Bube Dario</span> organisiert das Event
                            <span class="b">“Longieren: bewegen, beschäftigen,
                            fördern”</span> am Sonntag, 11.04.12.
                        </div>
                        <div class="top-border-dotted">
                            <img src="i/fish-2.png" />
                            <span class="b">Bube Dario</span> organisiert das Event
                            <span class="b">“Longieren: bewegen, beschäftigen,
                            fördern”</span> am Sonntag, 11.04.12.
                        </div>
                        <div class="top-border-dotted">
                            <img src="i/fish-3.png" />
                            <span class="b">Bube Dario</span> organisiert das Event
                            <span class="b">“Longieren: bewegen, beschäftigen,
                            fördern”</span> am Sonntag, 11.04.12.
                        </div>
                    </td>
                    <td class="mid">
                        <h2>Was ist Petroom</h2>
                        <div class="main-video">
                            <img src="i/video.png" />
                        </div>
                    </td>
                    <td class="r">
                        <h2>Petroom-Vorteile</h2>
                        <ul class="lst">
                            <li>Kostenlose Mitgliedschaft</li>
                            <li style="height: 48px;">Kommunikation mit<br /> Gleichgesinnten</li>
                            <li>Teilen von Erfahrungen</li>
                            <li>Information über aktuelle Events</li>
                            <li>Bereits über 20000 Mitglieder</li>
                            <li>Gratis Ratschläge</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>