<?php
declare(strict_types = 1);

namespace popp\ch09\batch14;

class Runner
{
    public static function run()
    {
        // 现在我们可以在保持组件的灵活性的基础上动态地实例化对象了。
        // AppointmentMaker2类不再像以前那样采取硬编码方式时那样依赖ApptEncoder的实例了。

        // 虽然依赖注入能够高度解耦类间的依赖关系，但它会产生另一种形式的依赖。即依赖装配器。

        // 创建对象的两种策略：服务定位器和依赖注入。
        $assembler = new ObjectAssembler("src/ch09/batch14/objects.xml");
        $apptmaker = $assembler->getComponent("\\popp\\ch09\\batch14\\AppointmentMaker2");
        $out = $apptmaker->makeAppointment();
        print $out;
    }
}
