<?php // Template Name: Contact Us ?>

<?php get_header(); ?>

<div class="boxed-content">
    <div class="inner">
        <section>
            <h1 class="title">Get in Touch with Us!</h1>
            <p>Please take a moment to complete the following fields to receive more informaton on the Arxlab system.</p>
            <p>Do you need to:</p>
            <ul>
                <li>Move on from paper lab notebooks?</li>
                <li>Replace an existing ELN system?</li>
                <li>Connect with external research partners?</li>
                <li>Integrate internal systems with a cloud ELN system?</li>
                <li>Manage other scientific workflows, such as inventory management or compound/material registration?</li>
                <li>Centralize your laboratory operations?</li>
            </ul>
            <p>We will show you how the Arxlab platform can help you effectively manage your scientific data and improve your research productivity.</p>
        </section>

        <aside>
            <form id="contact-form" class="default-form" novalidate>
                <div class="fields">
                    <div class="field">
                        <label>First Name:*</label>
                        <input type="text" name="fname" required value="devon" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Last Name:*</label>
                        <input type="text" name="lname" required value="riley" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Email:*</label>
                        <input type="email" name="email" required value="dev@Knowncreative.co" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Company:*</label>
                        <input type="text" name="company" required value="known" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Title:</label>
                        <input type="text" name="title" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Phone Number:</label>
                        <input type="text" name="phone" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
<!--                        <label>Type of Request:*</label>-->
                        <select required name="request">
                            <option>Please select one</option>
                            <option>Request 1</option>
                        </select>
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <input type="submit" id="submit" value="Contact Us" class="btn" />
                    </div>
                </div>
                <div class="form-success">

                </div>
            </form>
        </aside>
    </div>
</div>

<?php get_footer(); ?>